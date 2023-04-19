function frontend_validation(){
    var fname = document.getElementById("firstname").value;
    var lname = document.getElementById("lastname").value;

    if(fname=="" || lname==""){
        alert("fill all the blanks");
        return false;
    }else{
        return true;
    }


}