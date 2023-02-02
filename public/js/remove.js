$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".delete").click(function(e){
        e.preventDefault();

        var id = $("input[name=name]").val();

        $.ajax({
           type:'POST',
           url:"/api/product",
           data:{name:name, password:password, email:email},
           success:function(data){
              alert(data.success);
           }
        });

    });
