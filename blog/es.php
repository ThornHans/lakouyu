
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

  <style type="text/css">
      
      .container{
        min-height: 100px;
         overflow: auto;
      }
  </style>
</head>
<body>

<div>
    
    jijijijijiji<br/>
    bjjnjn<br/>
    n<br/>v<br/>vvvvv<br/>ccc<br/>cccc<br/>ccc<br/>ccccc<br/>cccc<br/>br/>
    ijijijijijiji<br/>
    jjjnjnjnjnjnj<br/>
    ojkjikikik<br/>
    bjjnjn<br/>
    n<br/>v<br/>vvv
</div>

<div class='container'>
   
  
</div>
<div>
    
    jijijijijiji<br/>
    jjjnjnjnjnjnj<br/>
    ojkjikikik<br/>
    bjjnjn<br/>
    n<br/>v<br/>vvvvv<br/>ccc<br/>cccc<br/>ccc<br/>ccccc<br/>cccc<br/>br/>
    ijijijijijiji<br/>
    jjjnjnjnjnjnj<br/>
    ojkjikikik<br/>
    bjjnjn<br/>
    n<br/>v<br/>vvv
</div>


<script> 
$(document).ready(function($){
     n = 0;

     $.ajax({
                data: {i:n},
                type:'post',
                url:'getblogs.php',
                success:function(data){
                    console.log(data);
                    $('.container').append(data);
                    n+=1;
                }

            });


 
    Elm = document.querySelector('.container');

    // Get the current offset - how far "scrolled down"    
   

    // Check if user has hit the end of page
   
    window.addEventListener("scroll",function(event) {

       
        // pagination_height = document.documentElement.scrollHeight - el.clientHeight;
        scrollTop = this.scrollY;
       
 
      
        if(scrollTop + Elm.clientHeight >= document.documentElement.scrollHeight) {

            $.ajax({
                data: {i:n},
                type:'post',
                url:'getblogs.php',
                success:function(data){
                    console.log('n: '+data);
                    $('.container').append(data);
                    n+=1;
                }

            });
       
        }
    }
    );



    
}
);
</script>
</body>
</html>


