function sum(id) {
    var txtFirstNumberValue = document.getElementById(id).value;
    var txtSecondNumberValue = document.getElementById('txt2').value;
    var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
    if (!isNaN(result)) {
    //    document.getElementById('txt3').value = result;
    console.log("TEST ", result);
    }
}

function sumTotal() {

    var x = document.getElementById("jumlah_jual");
    var y = document.getElementById("harga_jual_sales");

    var sum = parseInt(x.value) * parseInt(y.value);    
    if(sum.value == isNaN()){
        alert('perhitungan tidak valid');
    }
    document.getElementById("total_harga").value = sum;
    


    console.log("TOTAL HARGA ",sum);
}
