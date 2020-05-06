$(document).ready(function() {
    $('.save').on('click',function(e){
        e.preventDefault();
        var data = $('.queryForm').serialize();
        var url = $('.queryForm').attr('action')+"/query-save";
        $.ajax({
            url: url,
            type:'POST',
            data: data,
            success: function(res){
                $('#status').html(res);
                $('#statusModal').modal('show');
            }
        });
    })
    $('.result').on('click',function(e){
        e.preventDefault();
        var data = $('.queryForm').serialize();
        var url = $('.queryForm').attr('action')+"/query-result";
        $.ajax({
            url: url,
            type:'POST',
            data: data,
            success: function(res){
                $('#status').html(res);
                $('#statusModal').modal('show');
                $( ".rs").remove();
            }
        });
    })
});