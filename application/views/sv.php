<!DOCTYPE html>
<html>
<head>
  <title>高登&天使国际英语---Backend Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="天使高登国际英语 英吉利高端英语 韩鹏 周周 Jojo Hansen Daria 国际化 高端 个性化 Chris Albert 可定制化 高端英语教育培训 纯国际团队打造 提升二三四线城市英语教育水平 在线外教 来自欧美 出国夏令营" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />

    <style type="text/css">
        /*.popup {
            background-color:ivory; border:1px solid gray; z-index:100;
            position:fixed; display:none; padding: 0px 20px 10px 10px;
            top:20%;

           opacity:0.7;
        }
        .campus{
          margin-bottom:1em;
        }*/

        .schedule{
           
            position: fixed;
            top: 10;
            z-index:100;
           
         
        }

        @media screen and (max-width:800px) {
          .schedule {display: none;}
          
        }

    </style>

</head>
<body>
  
<div class="container text-center" style="height: 60%">
    <h1>高登&天使国际英语后台管理系统</h1>
    

    <div class="row schedule">
      <div class="col-md-12 ">
        <div class="opts">
        Title:
        <select  class="title">
        <option value="Lesson">Lesson</option>
        <option value="Meeting">Meeting</option>
        <option value="Summer Camp">Summer Camp</option>
        <option value="test">Test</option>
        <option value="English Club">English Club</option>

        </select>
        Lecturer:
        <select multiple size="3" class="lecturer">
          <option value="Alex">Alex</option>
          <option value="Albert">Albert</option>
          <option value="Christian">Christian</option>
          <option value="Daria">Daria</option>
          <option value="Hansen">Hansen</option>
          <option value="Jojo">Jojo</option>
          <option value="Xiao">Xiao</option>
       
       
        </select>
        TA:
        <select class="TA">
        <option value="N/A">N/A</option>
        <option value="Hansen">Hansen</option>
        <option value="Jojo">Jojo</option>
        <option value="Xiao">Xiao</option>
        </select>
Campus:
        <select class="campus">
        <option value="Campus Jinsanjiao">Campus Jinsanjiao</option>
        <option value="Campus Daping China Moible">Campus Daping China Moible</option>
        <option value="Campus Daping AgriMarket">Campus Daping AgriMarket</option>
        <option value="Campus Shaoyang">Campus Shaoyang</option>
        </select>
Classroom:
        <select class="classroom">
        <option value="Rm 01">Rm 01</option>
        <option value="Rm 02">Rm 02</option>
        <option value="Rm 03">Rm 03</option>
        <option value="Rm 04">Rm 04</option>
        </select>
Course:
        <select class="course">
        <option value="Speaking">Speaking</option>
        <option value="Grammar">Grammar</option>
        <option value="Vocabulary">Vocabulary</option>
        <option value="Listening">Listening</option>
        <option value="Miscellaneous">Miscellaneous</option>
        <option value="Reading">Reading</option>
        <option value="Writing">Writing</option>
       </select>
Type:
        <select class="type">
        <option value="Online">Online</option>
        <option value="Offline">Offline</option>
        <option value="O2O">O2O</option>
       
        </select>
     
        </div>
    </div>
   </div>
   <br/><br/>  <br/>
   <div class="row " >
       <div class="col-md-12">
           <div id="calendar"></div>
       
        <br/>
    </div>  

</div>



<br/>
<br/>
<br/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<script type="text/javascript">

let classList = ['title','lecturer','classroom','TA','campus','course'];
var btnClicked = false;
var jsonList = {};

var t, l, cl, ta, cn, ca;

test = $('.opts').change(function(){
                      
                     var lecturers = [];
                      $.each($(".lecturer option:selected"), function(){            
                          lecturers.push($(this).val());
                      });
                      jsonList.l = lecturers.toString();
                     taV = $('.TA').children("option:selected").val();
                     jsonList.ta = taV;
                     tV = $('.title').children("option:selected").val();
                     jsonList.t = tV;
                     clV = $('.classroom').children("option:selected").val();
                     jsonList.cl = clV;
                     cV = $('.course').children("option:selected").val();
                     jsonList.cn = cV;
                     caV = $('.campus').children("option:selected").val();
                     jsonList.ca = caV;
                     tyV = $('.type').children("option:selected").val();
                     jsonList.ty = tyV;
                  
                      });

console.log(jsonList);

    $(document).ready(function() {
    
     
      $('.title').multiple = true;
                    
   
    var events = <?php echo json_encode($data) ?>;
    
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    var calendar = $('#calendar').fullCalendar({
   
    defaultView: 'month', 
    editable: true,
    slotDuration: '00:05:00', 
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
    events: events,
                                          

    selectable:true,
    selectHelper:true,


    

    select: function(start, end, allDay)

    {
                                               
       let t = jsonList.t;
       let l = jsonList.l;
       let cl = jsonList.cl;
       let ta = jsonList.ta;
       let ca = jsonList.ca;
       let cn = jsonList.cn;
       let ty = jsonList.ty;

                                        
      

     
     
    console.log(ca);


     if(l && t && ca && cl && cn &&ta && ty)
     {
                                               
      if(confirm('your selection is '+l+' '+t+' '+ca+' '+cl+' '+cn+' '+ta+' '+ty))
      {                       
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
         url: "insert",
         type:"POST",
         data:{l:l,t:t,ta:ta,ca:ca,cl:cl,cn:cn,start:start,end:end,ty:ty},
         success:function()
         {
          calendar.fullCalendar('refetchEvents');
          alert("Added Successfully");
               console.log(events);
         }
        });
      }

     }
    },

    editable:true,
    
    eventResize:function(event)
    {
       let t = jsonList.t;
       let l = jsonList.l;
       let cl = jsonList.cl;
       let ta = jsonList.ta;
       let ca = jsonList.ca;
       let cn = jsonList.cn;
       let ty = jsonList.ty;
       var title = event.title;

       var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
       var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
       var id = event.id;
       if(l && t && ca && cl && cn &&ta && ty)
       {
       
       if(confirm('your selection is '+l+' '+t+' '+ca+' '+cl+' '+cn+' '+ta+' '+ty))
       {
       
       $.ajax({
              url: "update",
              type:"POST",
              data:{l:l,t:t,ta:ta,ca:ca,cl:cl,cn:cn,start:start,end:end,ty:ty,id:id},
              success:function()
              {
              calendar.fullCalendar('refetchEvents');
              alert("Updated Successfully");
              console.log(events);
              }
              });
       }
       
       }
       
       else {
           
           $.ajax({
                  url:"update",
                  type:"POST",
                  data:{t:title, start:start, end:end, id:id},
                  success:function(){
                  calendar.fullCalendar('refetchEvents');
                  alert('Updated Successfully'+end);
                  
                  }
                  });
       }
    
     
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
   
</script>
   
</body>
</html>
