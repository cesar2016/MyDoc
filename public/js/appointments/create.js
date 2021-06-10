$(function () {

    $('#doctor').prop( "disabled", true );
    $('#date').prop( "disabled", true );  

    $('#specialty').change(function () { 
       
        const specialtyId =  $(this).val();
        const url = `/specialties/${specialtyId}/doctors`;

        $.getJSON(url, getDoctors);
 
        function getDoctors(doctors) {
            if(doctors.length < 1){
                $('#doctor').val('');                
                $('#doctor').prop( "disabled", true );
                $('#date').prop( "disabled", true );
                
            }else{
                doctors.forEach(doctor => {
                    $('#doctor').prop( "disabled", false );
                    $('#date').prop( "disabled", false );
                    $('#doctor').html("<option value="+doctor.id+">"+doctor.name+"</option>");
                    loadHours();
                });
            }// End. if            
            
        }//End. getDoctos
         
    });//End. Specialty

    $('#doctors').change(function () { 
        loadHours();
    });// End. doctors
    $('#date').change(function () { 
        loadHours();
    });// End. date

    function loadHours(){
        const doctor = $('#doctor').val();
        const date = $('#date').val();
                 
        const url = `/schedule/hours?date=${date}&doctor_id=${doctor}`;         
        $.getJSON(url, getDisplayHours);
        function getDisplayHours(data){ 

            var htmHours = '';            
            if(data.length < 1){     
                $("#hours").html(' ... ');                                                
                $('#ErroNoDate').html("<span class='text-danger'> Ups no hay fechas para este dia <i class='fa fa-exclamation-triangle'></i></span>")                
               return
            }
                        
            if(data.morning){         
                $('#ErroNoDate').html("<span class='text-success'> Fechas encontradas <i class='fa fa-check'></i></span>")                        
                const mornig_intervals = data.morning;
                mornig_intervals.forEach(interval => {
                    htmHours += getRadioIntervalHtml(interval) ;

                });
            }             
            if(data.afternoon){
                $('#ErroNoDate').html("<span class='text-success'> Fechas encontradas <i class='fa fa-check'></i></span>")    
                const afternoon_intervals = data.afternoon;
                afternoon_intervals.forEach(interval => {
                    htmHours += getRadioIntervalHtml(interval) ;
                     
                });
            }              
            $("#hours").html(htmHours);             
        }   
        var iRadio = 0;
        function getRadioIntervalHtml(interval){
            var text = interval.start+' - '+interval.end;             
            return `<div class="custom-control custom-radio">
                        <input type="radio" id="interval${iRadio}" name="scheduled_time" class="custom-control-input" value="${interval.start}">
                        <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
                    </div>`
        }      
    }//End. loadHours()

     
    
    
});