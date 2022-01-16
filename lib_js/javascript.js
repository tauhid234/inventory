function sum(id) {

    let harga_sales = Number(document.getElementById('harga_sales_'+id).value);
    let harga_admin = Number(document.getElementById('harga_admin_'+id).value);

    // RESET INPUTAN KETIKA HARGA SALES TIDAK JADI INPUT/
    if(harga_sales == "" || harga_sales == 0 || harga_sales < 0){
        document.getElementById('jumlah_jual_'+id).value = "";
        document.getElementById('total_seluruh_'+id).value = "";
        return;
    }

    let jumlah_jual = Number(document.getElementById('jumlah_jual_'+id).value);

    if(jumlah_jual !== 0){
        // CEK HARGA ADMIN DAN SALES -> JIKA TERJADI KESAMAAN ATAU KEKURANGAN DARI HARGA ADMIN
        if(harga_sales <  harga_admin || harga_sales == harga_admin){
            alert('Harga jual sales tidak boleh kurang dari harga jual admin, atau sama dengan harga jual admin');
            document.getElementById('harga_sales_'+id).value = "";
            document.getElementById("jumlah_jual_"+id).value = "";
            return;
        }
    }
    if(jumlah_jual == 0 || jumlah_jual < 0){
        alert('Inputkan bilangan angka tidak boleh kurang dari 1 atau tidak boleh lebih dari total stock');
        // document.getElementById('harga_sales_'+id).value = "";
        document.getElementById("jumlah_jual_"+id).value = "";
        document.getElementById("total_seluruh_"+id).value = "";
        return;
    }

    let stock = Number(document.getElementById('stock_'+id).value);
    
    // JUMLAH JUAL TIDAK BOLEH LEBIH DARI STOCK BARANG 
    if(jumlah_jual > stock){
        alert('Jumlah jual tidak boleh melebihi batas jumlah stock');
        document.getElementById("jumlah_jual_"+id).value = "";
        document.getElementById("total_seluruh_"+id).value = "";
        return;
    }
    // else if(jumlah_jual == 0 || jumlah_jual < 0){
    //     alert('Jumlah jual tidak valid, inputkan jumlah jual yang benar');
    //     document.getElementById("jumlah_jual_"+id).value = "";
    //     document.getElementById("total_seluruh_"+id).value = "";
    //     return;
    // }
    
    let total = harga_sales * jumlah_jual;    
    document.getElementById("total_seluruh_"+id).value = total;
    
}

function myTable(){
        
        var table = document.getElementById("mytable");
        var totalRow = table.rows.length;
        var sum = totalRow - 1;
        console.log("TOTAL ROW ",sum);

        var row = table.insertRow(sum);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);

        cell1.innerHTML = "<input type='text' name='no_invoice[]' class='form-control' id='required' required>";
        cell2.innerHTML = "<input type='text' name='nama_barang[]' class='form-control' id='required' required>";
        cell3.innerHTML = "<input type='number' name='ukuran[]' class='form-control' required>";
        cell4.innerHTML = "<input type='text' name='jenis_ukuran[]' class='form-control' required>";
        cell5.innerHTML = "<input type='text' name='jenis_satuan[]' class='form-control' required>";
        cell6.innerHTML = "<input type='number' name='harga_pembelian[]' class='form-control' required>";
        cell7.innerHTML = "<input type='number' name='jumlah_beli[]' class='form-control' required>";
        cell8.innerHTML = "<input type='number' name='total_harga[]' class='form-control' required>";

}

function removeTable(){

    var table = document.getElementById("mytable");
    var totalRow = table.rows.length;

    document.getElementById("mytable").deleteRow(deletes);
}

function sumRetur(id){

    let jumlah_jual = Number(document.getElementById('jumlah_jual_'+id).value);
    let harga_jual = Number(document.getElementById('harga_jual_'+id).value);
    let jumlah_retur = Number(document.getElementById('jumlah_retur_'+id).value);

    if(jumlah_retur == ""){
        document.getElementById('total_potongan_'+id).value = "";
        return;
    }

    let total_amount = Number(document.getElementById('total_amount_'+id).value);

    let sum = jumlah_jual - jumlah_retur;

    if(jumlah_jual < jumlah_retur){
        alert("Peringatan jumlah retur tidak boleh lebih dari jumlah jual barang");
        document.getElementById('jumlah_retur_'+id).value = "";
        document.getElementById('total_potongan_'+id).value = "";
        return;
    }

    if(jumlah_retur < 0 || jumlah_retur == 0){
        alert("Peringatan jumlah retur tidak boleh kurang dari 0 atau sama dengan 0");
        return;
    }
    let totality = sum * harga_jual;

    document.getElementById('total_potongan_'+id).value = totality;
    console.log("RETUR ", totality);

}

function sumV2(id){
    let harga_beli = Number(document.getElementById('harga_beli_'+id).value);
    let harga_jual = Number(document.getElementById('harga_jual_'+id).value);
    let jumlah_beli = Number(document.getElementById('jumlah_beli_'+id).value);

    if(harga_beli == 0 || harga_beli == "" || harga_beli == undefined){
        document.getElementById('jumlah_beli_'+id).value = "";
        document.getElementById('total_transaksi_pembelian_'+id).value = "";
        return;
    }

    if(harga_jual == 0 || harga_jual == "" || harga_jual == undefined){
        document.getElementById('jumlah_beli_'+id).value = "";
        document.getElementById('total_transaksi_pembelian_'+id).value = "";
        return;
    }

    if(jumlah_beli < 0 || jumlah_beli == 0){
        alert("Jumlah beli tidak boleh kurang dari 0 atau sama dengan 0");
        document.getElementById('jumlah_beli_'+id).value = "";
        document.getElementById('total_transaksi_pembelian_'+id).value = "";
        return;
    }

    let sum = harga_beli * jumlah_beli;
    console.log("SUM "+sum);

    document.getElementById('total_transaksi_pembelian_'+id).value = sum;
}