new Vue({
    el: '#reserva',
    data: {
        canchas: [],
        horas: [],
        can_hs: [],
        newFecha: '', newCancha_id: '', newHr_reservada: '', newCant_hs: '', newServicio: '',
        errors: [],
        servicios: [],
        monto: '',
        editar: '',
    },
    methods: {

        getCanchas: function() {
            const param = {
                fecha_reservada: this.newFecha
            };
            var url = 'consultar/fecha/canchas/disponibles';
            axios.post(url,param).then(response => {
                    this.canchas = response.data
            }).catch(error => {
                this.errors = error.response.data
            });         
        },

        getHoras: function() {
            
            const param = {
                fecha_reservada: this.newFecha,
                cancha_id: this.newCancha_id
            };           

            var url = 'consultar/horas/disponible';
            axios.post(url,param).then(response => {
                this.horas = response.data
            }).catch(error => {
                this.errors = error.response.data
            }); 
        },

        getHsRes: function() {
            const param = {
                fecha_reservada: this.newFecha,
                cancha_id: this.newCancha_id,
                hr_reservada: this.newHr_reservada
            }; 

            var url = 'consultar/horas/a/reservar';
            axios.post(url,param).then(response => {
                this.can_hs = response.data
            }).catch(error => {
                this.errors = error.response.data
            }); 
        },

        getServicios: function() {
            
            var url = 'consultar/servicios/' + this.newCancha_id;
            axios.get(url).then(response => {
                this.servicios = response.data
            });
        },

        getMonto: function() {
            var url = 'consultar/monto/' + this.newCancha_id + '/' + this.newCant_hs;
            axios.get(url).then(response => {
                this.monto = response.data
            });
        },

        storeReserva: function(){
            const params = {
                fecha_reservada: this.newFecha,
                cancha_id: this.newCancha_id,
                hr_reservada: this.newHr_reservada,
                cant_hs: this.newCant_hs
            };
            var url='reserva';
            axios.post(url,params).then(response => {
                this.canchas = [];
                this.horas = [];
                this.newFecha = '';
                this.newCancha_id = '';
                this.newHr_reservada = '';
                this.newCant_hs = '';
                this.monto = '';
                this.newServicio = [];
                this.errors = [];
                $('#modalReserva').modal('hide');
                $('#modalConfirmacion').modal('hide');
                toastr.options.positionClass = 'toast-top-left';
                toastr.success('Su Reserva se Realizo con EXITO!');
            }).catch(error => {
                this.errors = error.response.data
            });
        }
    }
});

