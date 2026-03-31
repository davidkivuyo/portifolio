const slider = document.querySelector(".logo-slider");
const track = document.querySelector(".logo-track");
const logos = Array.from(track.children);


logos.forEach((logo) => {
  const clone = logo.cloneNode(true);
  track.appendChild(clone);
});

slider.addEventListener("mouseover", () => {
  track.style.animationPlayState = "paused";
});

slider.addEventListener("mouseout", () => {
  track.style.animationPlayState = "running";
});



const splash = document.querySelector(".splash");

document.addEventListener("DOMContentLoaded", (e)=>{
 setTimeout(()=>{
  splash.classList.add("display-none");
 }, 4000);
})


$("#handWrap").on("mousemove",function(e){
    // I played with sin/cos/half-width etc, but doesn't worked
    $('#hand').css({'left':e.pageX-130,'top':e.pageY-44});
});