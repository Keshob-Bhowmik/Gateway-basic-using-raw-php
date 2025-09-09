const cardNumber = document.getElementById("card-number")
const mm = document.getElementById("mm")
const yy = document.getElementById("YY")
const cvv = document.getElementById("cvv")
const cardHolder = document.getElementById("card-holder")
const cardNumberWarning = document.getElementById("cardNumberWarning")
cardNumber.addEventListener('input', ()=>{
    const mm = document.getElementById("mm")
    if(cardNumber.value.length==16){
        mm.focus()
    }
})
mm.addEventListener('input', ()=>{
    if(mm.value.length==2){
        yy.focus()
    }
})
yy.addEventListener('input', ()=>{
    if(yy.value.length==2){
        cvv.focus()
    }
})
cvv.addEventListener('input', ()=>{
    if(cvv.value.length==3){
        cardHolder.focus()
    }
})
