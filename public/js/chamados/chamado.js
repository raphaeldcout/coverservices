
$(window).on("load",function () {    
    carregarProblema();
})

function carregarProblema(){
    $('#categoria').on("change",function (e) {
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
               var count = 0;
               var idSelect = '';
               
               $('#problema option').each(function(){
                   if($(this).val() != '-1'){
                       this.remove();
                   }
               })
               problema.forEach((element,i)=>{
                option = $('<option value="' + element.id + '">' + element.name + '</option>');                
               if(count == 1){
                $('#problema').attr('selected', true)
                }else{
                    $('#problema').attr('selected', false)
                }
                $('#problema').append(option);
                count++
                idSelect = element.id
               })        
               if(count == 1) {
                   $('#problema').val(idSelect).prop('selected', true)
               }
            },
            error: function(data) {
            }
        });
    })    
}