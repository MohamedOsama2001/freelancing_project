fetch('http://127.0.0.1:8000/api/users')
.then((res)=>res.json())
.then((data)=>{console.log(data)})
.catch((error)=>{console.log(error)})