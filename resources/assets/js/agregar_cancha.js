new Vue({
    el: '#agregar_cancha',

    data: {
        canchas: [],
    },
    methods: {
        getCanchas: function() {
            var url = 'detalle/consultar/cancha/' + this.oldFecha + '/' + this.oldoldHr_reservada + '/' + this.oldCant_hs;
            axios.get(url).then(response => {
                this.canchas = response.data
            });
        }
});