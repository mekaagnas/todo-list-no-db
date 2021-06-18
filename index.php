<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
   <div class="container">
       <form style="display:flex;flex-direction:column">
           <input id="name" style="border: 1px solid black;width:80vh;margin-bottom:10px" type="text" placeholder="Todo Name">
           <button id="new" style="width:80vh" class="btn btn-primary">Insert Todo</button>
       </form>
        <table class="table" id="data-table">
            <th>ID</th>
            <th>TODO NAME</th>
            <th>Action</th>
        </table>
   </div>
</body>


<script>

$(document).ready(function(){


    $(document).on('click', "#new", function (evt) {

        $name = $('#name').val()

        $.ajax({
            type:"POST",
            dataType: "json",
            data:{choice: 'store',name: $name},
            url:"http://todo-list.test/todocontroller.php/",
            success:function(data)
            {
               alert('Successfully Insert')
            }
        });
    })

    $(document).on('click', "#update", function (evt) {
        var $row = $(this).closest("tr");    
        var $id = $row.find(".nr").text(); 
        var $name = $row.find('.nw').val();
 
        $.ajax({
            type:"POST",
            dataType: "json",
            data:{choice: 'update',name: $name , id : $id},
            url:"http://todo-list.test/todocontroller.php/",
            success:function(data)
            {
               alert('Successfully Update')
            }
        });
    })

    $(document).on('click', "#delete", function (evt) {
        var $row = $(this).closest("tr");    
        var $id = $row.find(".nr").text(); 


        $.ajax({
            type:"POST",
            dataType: "json",
            data:{choice: 'delete',id : $id},
            url:"http://todo-list.test/todocontroller.php/",
            success:function(data)
            {
               alert('Successfully Deleted')
            }
        });

        $(`#row_${$id}`).remove();
    })

    $.ajax({
        type:"POST",
        dataType: "json",
        data:{choice: 'index'},
        headers: {'Access-Control-Allow-Origin': 'http://todo-list.test/todocontroller.php' },
        crossDomain : true,
        url:"http://todo-list.test/todocontroller.php/",
        success:function(data)
        {
            data.map(d => {
                let string = `<tr id="row_${d.id}">
                                <td class="nr">${d.id}</td>
                                <td><input  class="nw" type="text"  value="${d.name}"/></td>
                                <td class="btn-display">
                                    <button id="update" class="btn btn-primary" id="update">Update</button>
                                    <button id="delete" class="btn btn-danger" id="delete">Delete</button>
                                </td>
                             </tr>
                            `

               $("#data-table").append(string)
            })
        }
    });

});
</script>
</html>

<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap');

body{
    font-family: 'Open Sans', sans-serif;
}
.container{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
.btn-display{
    display: flex;
    justify-content: flex-end
}
.btn{
    font-family: 'Open Sans';
    font-weight: 100;
    border: 0;
    padding: 10px 20px;
    color: white;
    margin-right: 10px;
}
.btn-danger{
    background-color: #e74c3c;
}
.btn-primary{
    background-color: #2980b9;
}
.btn-danger:hover{
    background-color: #e74c5c;
    cursor: pointer;
}
.btn-primary:hover{
    background-color: #2950b9;
    cursor: pointer;
}

.table{
 
    width: 80vh;
}
.table tr td{
    border: 1px solid #f1c40f;
    padding: 10px;
}

input{
    padding: 10px;
    outline: none;
    border: none;
}
</style>