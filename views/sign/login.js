const monkeyFace = document.querySelector('.monkey-face');
const monkeyHand = document.querySelector('.monkey-hand');
const email = document.getElementById('email');
const monkeyThought = document.querySelector('.monkey-thought');
const monkeyEyesBrows = document.querySelectorAll('.eye-brow')

const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

let degree = 13
let inputPrevLenght = [];

const showMonkeyHand = () =>{
  monkeyHand.style.transform='translateY(35%)'
}

document.addEventListener('click',(e)=>{
  if(e.target.type!=='password'){
    monkeyHand.style.transform='translateY(120%)'
  }
  if(e.target.type!=='email'){
   monkeyFace.style.transform = `perspective(800px) rotateZ(0deg)`;
   monkeyEyesBrows.forEach((eyeBrow)=>{
    eyeBrow.style.transform = 'translateY(-2px)'
  })
  }
  
});

// move monkey face
email.addEventListener('input',(e)=>{
  let currentInputLength = String(e.target.value).length;
  let decrementInInputValue = inputPrevLenght.includes(currentInputLength);
  if(!decrementInInputValue && degree>= -10){
    degree-=1
    inputPrevLenght.push(currentInputLength)
  }
  if(decrementInInputValue && degree<13){
    degree+=1
  }
  if(!email.value.match(mailformat)){
    monkeyThought.style.opacity='1';
      monkeyEyesBrows.forEach((eyeBrow)=>{
        eyeBrow.style.transform = 'translateY(3px)'
      })
  };
  if(email.value.match(mailformat)){
    monkeyThought.style.opacity='0';
    monkeyEyesBrows.forEach((eyeBrow)=>{
      eyeBrow.style.transform = 'translateY(-3px)'
    })
  };
  monkeyFace.style.transform = `perspective(800px) rotateZ(${degree}deg)`
});
