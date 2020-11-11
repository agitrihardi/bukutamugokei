fetch('http://localhost/bukutamuu/api/keperluan').then(
    Response=>{
        Response.json().then(
            data=>{
                console.log(data);
                if(data.length > 0){
                    var temp = "";

                    data.array.forEach(u => {
                        temp +="<tr>";
                        temp +="<td>" + u.kode_keperluan +"</td>";
                        temp +="<td>" + u.keperluan +"</td></tr>";
                    })

                    document.getElementById("data").innerHTML = temp;
                }
            }
        )
    }
)