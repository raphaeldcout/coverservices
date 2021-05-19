
$(document).ready(function () {
 $('#categoria').change(function (e) {
     var _token = $('input[name="_token"]').val();
     var categoria = $(this).val()
     var url = '/search/select/categoria'
     $.ajax({
         type: "POST",
         url: url,
         data: {
             _token: _token,
             categoria: categoria
         },
         beforeSend: function() {

         },
         complete: function(data) {

         },
         success: function(data) {
            data = JSON.parse(JSON.stringify(data));
            problema = data.problemas;
            
            $('#problema option').each(function(){
                if($(this).val() != '-1'){
                    this.remove();
                }
            })
            problema.forEach((element,i)=>{
                console.log(i)
                if(i == 0){
                    option = $('<option selected value="' + element.id + '">' + element.name + '</option>');
                }else{
                    option = $('<option value="' + element.id + '">' + element.name + '</option>');
                }
                
                
                $('#problema').append(option);

            })               

         },
         error: function(data) {

         }
     });
 })
});