
$(window).on("load",function () {
    carregarProblema();
    if($('#dataChamado').val() !== undefined){
        $('table tr td input').each(function(){
            var dataChamado = $(this).val()
            dataChamado = dataChamado.split('-')
            removeHora = dataChamado[2].split(' ')
            $(this).val(removeHora[0]+'/'+dataChamado[1]+'/'+dataChamado[0])
        })
    }

    if($('#statusController').val() !== undefined){
        $('#status option ').each(function(){
            if($('#statusController').val() == $(this).val()){
                $(this).prop('selected', true)
            }
        })
    }

    if($('#prioridadeController').val() !== undefined){
        $('#prioridade option ').each(function(){
            if($('#prioridadeController').val() == $(this).val()){
                $(this).prop('selected', true)
            }
        })
    }

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

                console.log(data)
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
