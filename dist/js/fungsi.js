function sum(id) {

    let harga_sales = Number(document.getElementById('harga_sales_'+id).value);
    let harga_admin = Number(document.getElementById('harga_admin_'+id).value);

    // RESET INPUTAN KETIKA HARGA SALES TIDAK JADI INPUT
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