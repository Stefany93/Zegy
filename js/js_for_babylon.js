// Connecting to the server using AJAX behind the scenes.
function server_connect(){
// We declare the $connection variable which will hold the
// core object depending on the browser. Now we have set it 
// equal to false since we do not know the user's browser 
// yet and we haven't defined the variable with the proper 
// object.
    var connection = false;
// We check whether the browser is any browser but IE 6 -
// Since IE 7, that MS browser supports the XMLHttpRequest object.
        if(window.XMLHttpRequest){
// If the browser supports the object and it doesn't 
// return 'undefined' make a new instance of the object and
// assign it to the $connection variable.
// If not, set $connection to false which means
// this browser doesn't support the XMLHttpObject
// and that means the user has IE version below 7.
            if(typeof XMLHttpRequest != "undefined"){
                try{
                    connection = new XMLHttpRequest();
                }catch(e){
                    connection = false;
                }
            }
// If the above evaluation fails,
// we make a new evaluation to set $connection with the
// right object, in this case, for IE 6 -
        }else if(window.ActiveXObject){
            try{
                connection = new ActiveXObject('Microsoft.XMLHTTP');
            }catch(e){
                try{
                    connection = new ActiveXObject('Msxml2.XMLHTTP');
                }catch(e){
                    connection = false;
                }
            }
        }
// The return value of this function is
// either the right AJAX server connection object
// or false which means that AJAX cannot connect for some reason.
        return connection;
}
// We set the object to a variable and now we can use its properties
// and methods when connecting to the server behind the scenes.
    var connection = server_connect();
// It's easy :-)


window.onload = function(){

    var uploaded_images = [];
// The adding comments thing without page reload thing. 
    var upload_image = document.getElementById("upload_image");
    var upload_image_form = document.getElementById("upload_image_form");
    var uploaded_images_list = document.getElementById("uploaded_images_list");
    if(upload_image != null){
   /* var commentator = document.getElementsByName("commentator")[0];
    var comment = document.getElementsByName("comment")[0];
    var post_id = document.getElementsByName("post_id")[0];
    var website = document.getElementsByName("website")[0];*/
        upload_image.onclick = function(event)
        {
        event.preventDefault();
        console.log(new FormData(upload_image_form));
        if(connection){
            connection.onreadystatechange = function(){
            if(connection.readyState == 4 && connection.status == 200)
            {
                uploaded_images_list.style.display = "block";
                console.log(connection.responseText);
                var json_obj = JSON.parse(connection.responseText);
               
                    
                console.log(uploaded_images);
                console.log(uploaded_images.indexOf(json_obj.file_url));
                  if (uploaded_images.indexOf(json_obj.file_url) == -1)
                  {
                    uploaded_images_list.innerHTML += '<li>'+json_obj.file_url+'</li>';
                  }
                  uploaded_images.push( json_obj.file_name, json_obj.file_url ) 
               
                /*if(json_obj.file_url in uploaded_images)
                {
                    return false;
                }else{
                    
                }*/


            }
        }
        }
        connection.open("POST", 'upload_image_ajax.php', true);
        connection.send(new FormData(upload_image_form));
      //  document.forms[0].reset();
    //  return false;
        }
    }
}