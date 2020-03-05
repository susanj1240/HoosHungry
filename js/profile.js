function showModal(){
    $('#myModal').modal('show')
}

//Allows user to edit the username
function editUsername(){
    var input = document.getElementById("usernameInput").value;

    if(input ==""){
        window.alert("Please enter username");
    } else{
        document.getElementById("username").innerHTML = input;
        $('#myModal').modal('hide');
    }
    document.getElementById("usernameInput").value ="";
    
}