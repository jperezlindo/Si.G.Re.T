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

    },
    methods: {

        getCanchas: function() {
            var url = 'reserva/consultar/fecha/canchas/disponibles/' + this.newFecha;
            axios.get(url).then(response => {
                this.canchas = response.data
            });
        },

        getHoras: function() {
            
            var url = 'reserva/consultar/horas/disponible/' + this.newFecha + '/' + this.newCancha_id;
            axios.get(url).then(response => {
                this.horas = response.data
            });
        },

        getHsRes: function() {
            
            var url = 'reserva/consultar/horas/a/reservar/' 
                            + this.newHr_reservada + '/' + this.newFecha + '/' + this.newCancha_id;
            axios.get(url).then(response => {
                this.can_hs = response.data
            });
        },

        getServicios: function() {
            
            var url = 'reserva/consultar/servicios/' + this.newCancha_id;
            axios.get(url).then(response => {
                this.servicios = response.data
            });
        },

        getMonto: function() {
            var url = 'reserva/consultar/monto/' + this.newCancha_id + '/' + this.newCant_hs;
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