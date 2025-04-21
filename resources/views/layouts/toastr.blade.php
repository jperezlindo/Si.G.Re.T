  <script>
      @if(Session::has('message'))
          var type = "{{ Session::get('alert-type', 'info') }}";
          switch(type){
              case 'info':
                  toastr.options.positionClass = 'toast-top-left';
                  toastr.info("{{ Session::get('message') }}");
                  break;
              
              case 'warning':
                  toastr.options.positionClass = 'toast-top-left';
                  toastr.warning("{{ Session::get('message') }}");
                  break;
              case 'success':
                  toastr.options.positionClass = 'toast-top-left';
                  toastr.success("{{ Session::get('message') }}");
                  break;
              case 'danger':
                  toastr.options.positionClass = 'toast-top-left';
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
      @endif
   </script>