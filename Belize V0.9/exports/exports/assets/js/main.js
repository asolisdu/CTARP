$('#nextBtn').click(function() {
  $('#mainCarousel').carousel('next');
});

$('#startAssessmentBtn').click(function() {
  $('#mainCarousel').carousel('next');
});

$('#backBtn').click(function() {
  $('#mainCarousel').carousel('prev');
});

$('#mainCarousel').on('slid.bs.carousel', function () {
    let currentIndex = $('.carousel-item.active').index() + 1;
    // console.log('Current index: '+currentIndex);
    if(currentIndex == 9){
       
        $('.lastSlideBtn').show();
        $('#nextBtn').hide();
        $('#nextBtn').show();
        
    } else if (currentIndex == 2){
        
        $('#backBtn').hide();
        $('#nextBtn').show();
        $('.lastSlideBtn').hide();
        
    } else if (currentIndex == 3){
        
        $('#backBtn').show();
        $('#nextBtn').show();
        $('.lastSlideBtn').hide();
        
    }
    else {
        
        $('.lastSlideBtn').hide();
        $('#nextBtn').show();
    }
})