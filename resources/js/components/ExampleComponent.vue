<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Registro de vehiculos</div>

                    <div class="card-body">
                        <form @submit.prevent="nuevoVehiculo" @reset.prevent="limpiarFormulario">
                            <div class="form-group row">
                                <label for="marca" class="col-md-4 col-form-label text-md-right">Marca</label>
                                <div class="col-md-6">
                                    <!-- <input type="text" class="form-control" v-model="vehiculo.marca" required autofocus> -->
                                    <!-- QUE SOLO ACEPTE MAYUSCULAS -->
                                    <input type="text" class="form-control" v-model="vehiculo.marca" required autofocus pattern="^[A-Z]{3,25}$" title="Solo se aceptan letras mayusculas">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="modelo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" v-model="vehiculo.modelo" required  pattern="^[A-Za-z]{4,25}$" title="Solo se aceptan letras">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="year" class="col-md-4 col-form-label text-md-right">Año</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" v-model="vehiculo.year" required pattern="^[0-9]{4}$" title="Solo se aceptan numeros" min="0000" max="9999">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="num_motor" class="col-md-4 col-form-label text-md-right">Numero de motor</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" v-model="vehiculo.num_motor" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Num_chasis" class="col-md-4 col-form-label text-md-right">Numero de chasis</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" v-model="vehiculo.Num_chasis" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
                                    </button>
                                    <button type="reset" class="btn btn-danger">
                                        Limpiar
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de vehiculos</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="7">
                                        <input type="text" class="form-control" v-model="buscar" placeholder="Buscar" @keyup="buscarVehiculo">
                                    </th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th>Numero de motor</th>
                                    <th>Numero de chasis</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="vehiculo in vehiculos" :key="vehiculo.id" @click="editarVehiculo(vehiculo)" :class="{'d-none': !vehiculo.mostrar}">
                                    <td>{{vehiculo.idVehiculo}}</td>
                                    <td>{{vehiculo.marca}}</td>
                                    <td>{{vehiculo.modelo}}</td>
                                    <td>{{vehiculo.year}}</td>
                                    <td>{{vehiculo.num_motor}}</td>
                                    <td>{{vehiculo.Num_chasis}}</td>
                                    <td>
                                        <button class="btn btn-danger" @click="eliminarVehiculo(vehiculo.idVehiculo)">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Notifications from 'vue-notification'
    export default {
        data() {
            return {
                accion: 'insertar',
                vehiculo: {
                    marca: '',
                    modelo: '',
                    year: '',
                    num_motor: '',
                    Num_chasis: ''
                },
                vehiculos: [],
                buscar: ''
            }
        },
        methods: {
            nuevoVehiculo() {
                if (this.accion == 'insertar') {
                    axios.post('/vehiculos', this.vehiculo)
                        .then(response => {
                            this.vehiculo.idVehiculo = response.data.id;
                            this.vehiculos.mostrar = true;
                            this.vehiculos.push(this.vehiculo);
                            alertify.success('Vehiculo registrado correctamente');
                            this.limpiarFormulario();
                        })
                        .catch(error => {
                            console.log(error);
                            alertify.error('Error al registrar vehiculo');
                        });
                } else {
                    axios.put('/vehiculos/' + this.vehiculo.idVehiculo, this.vehiculo)
                        .then(response => {
                            this.vehiculos.splice(this.vehiculos.findIndex(vehiculo => vehiculo.idVehiculo == this.vehiculo.idVehiculo), 1, this.vehiculo);
                            alertify.success('Vehiculo actualizado correctamente'); 
                            this.limpiarFormulario();
                        })
                        .catch(error => {
                            console.log(error);
                            alertify.error('Error al actualizar vehiculo');
                        });
                }
            },
            editarVehiculo(vehiculo) {
                this.accion = 'editar';
                this.vehiculo = JSON.parse(JSON.stringify(vehiculo));
            },
            limpiarFormulario() {
                this.vehiculo = {
                    marca: '',
                    modelo: '',
                    year: '',
                    num_motor: '',
                    Num_chasis: ''
                };
                this.accion = 'insertar';
            },
            eliminarVehiculo(id) {
                if (confirm('¿Esta seguro de eliminar el vehiculo?')) {
                    axios.post('/vehiculos/eliminar', {idVehiculo: id})
                        .then(response => {
                            this.vehiculos = this.vehiculos.filter(vehiculo => vehiculo.idVehiculo != id);
                            alertify.success('Vehiculo eliminado correctamente');
                            this.limpiarFormulario();
                        })
                        .catch(error => {
                            console.log(error);
                            alertify.error('Error al eliminar el vehiculo');
                        });
                }
            },
            obtenerVehiculos() {
                axios.get('/vehiculos')
                    .then(response => {
                        this.vehiculos = response.data;
                        this.vehiculos.forEach(vehiculo => {
                            vehiculo.mostrar = true;
                        });
                        this.$forceUpdate();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            buscarVehiculo() {
                this.vehiculos.forEach(vehiculo => {
                    if (vehiculo.marca.toLowerCase().includes(this.buscar.toLowerCase()) || vehiculo.modelo.toLowerCase().includes(this.buscar.toLowerCase()) || vehiculo.idVehiculo.toString().includes(this.buscar.toLowerCase())) {
                        vehiculo.mostrar = true;
                    } else {
                        vehiculo.mostrar = false;
                    }
                });
                this.$forceUpdate();
            }
        },
        mounted() {
            this.obtenerVehiculos();
        }
    }
</script>
