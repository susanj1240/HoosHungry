//Author: Susan Jang(sj7yj)
//Javascript for Live Search
//Used Ajax XMLHttp object
//reference: http://www.cs.virginia.edu/~up3f/cs4640/supplement/overview-ajax.php
function search(i){
   
    console.log("typing... " + i);
   if(window.XMLHttpRequest){
        var xhr = new XMLHttpRequest();
    } else{
        var xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
        
    xhr.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200) {
            document.getElementById("result").innerHTML=this.responseText;
        }
    }
    // }

    xhr.open("GET","../php/fetch.php?i="+i);
    xhr.send();
}