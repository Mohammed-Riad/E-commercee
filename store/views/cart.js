// let qunatity=document.querySelectorAll(".qunatity1");
// let button=document.getElementById("button").value;
// qunatity.addEventListener("click", function (e) {
//     e.preventDefault();
  
  
//   fetch("http://localhost/E_Commerce/views/cart.php", {
//     method: "POST",
//     headers: {
//         'Content-Type': 'application/x-www-form-urlencoded', 

//     },
//     body: `buttonclick=${button}`,
//   })
//     .then((waad) => waad.text())
//     .then((res) => {console.log(res);
    
//     });
// });




document.querySelectorAll('.breakdown').forEach(function(item) {
  item.addEventListener('blur', function(e) {
 
    // let   qun=qunatity.value;

    
    let arr=(e.target.id).split("/");console.log(arr);
    let cart_id=arr[1];
    let price=arr[2];

    let qun=e.target.value;
    // document.getElementById("subTotal").innerHTML=`${price*qun} JD`;
      fetch("http://localhost/E_Commerce/views/cart.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', 
    
        },
        body: `qunatity_by_js=${qun}&cart_id=${cart_id}`,
      })
        .then((waad) => waad.text())
        .then((res) => {
          // console.log(res);
        
        });

  });
   });


   document.querySelectorAll('.breakd').forEach(function(item) {
    item.addEventListener('blur', function(e) {
   
      // let   qun=qunatity.value;
  
      
      // let arr=(e.target.id).split("/");console.log(arr);
      // let cart_id=arr[1];
      // let price=arr[2];

      let qun=e.target.value;
      console.log(qun);
      // document.getElementById("subTotal").innerHTML=`${price*qun} JD`;
        fetch("http://localhost/E_Commerce/views/cart.php", {
          method: "POST",
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded', 
      
          },
          body: `qunatity_by_js=${qun}`,
        })
          .then((waad) => waad.text())
          .then((res) => {
            // console.log(res);
          
          });
  
    });
     });

     let quantityBySS=document.getElementsByClassName('quantityBy');

     [...quantityBySS].forEach(element => {
      let prodId= (element.id).slice(1);
      element.addEventListener('change', function() {
        //  console.log(element.value);
         console.log(prodId);
         fetch(`add_to_cart.php?ad=${prodId}&newQ=${element.value}` ,{
          method: 'GET', // or 'PUT'
          headers : {
              'Content-Type': 'application/x-www-form-urlencoded', 
          },
          })
          .then((response) => {
              response.text().then(res=>{
                  console.log(res);
                  // document.getElementById("wrapProducts").innerHTML = res;
              });
          })
          .catch((error) => {
              console.error('Error:', error);
          });
  }, false);
       });

       let loginButton=document.getElementById("buttonLogin");
       
//    document.addEventListener("blur",function(e){
//  console.log(e.target);
//    })


