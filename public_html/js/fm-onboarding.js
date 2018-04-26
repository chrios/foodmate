/*function peekSlideOut (){
  // Peek slideout
  setTimeout(function(){
    document.querySelector('.toggle-button').click();
    setTimeout(function(){
      document.querySelector('.toggle-button').click();
    }, 400);
  }, 100);
};

peekSlideOut();*/

// Initialise popovers
$( function () {
  $('[data-toggle="popover"]').popover('show')
  }
);

document.querySelector('#onboard-menu').addEventListener('click',
function() {
  $('[data-toggle="popover"]').popover('dispose')
});
