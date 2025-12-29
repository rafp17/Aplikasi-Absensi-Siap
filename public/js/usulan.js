const dokPLT=["Surat Pengantar Dinas","SK Jabatan Sebelumnya","SK Pangkat Terakhir","Surat Pernyataan Kesediaan"];
const dokPLH=["Surat Tugas PLH","SK Jabatan Definitif","SK Pangkat Terakhir"];
const dokMUTASI=["Surat Usulan Mutasi","SK Pangkat Terakhir","Ijazah","SKP"];
const dokREKOM=["Surat Pengantar Dinas","SK Jabatan Sebelumnya","SK Pangkat Terakhir","Surat Pernyataan Ketersediaan"];

function aturDokumen(){
 document.getElementById("dokumenArea").innerHTML="";
 let list=[];
 const jenis = document.getElementById("jenis").value;
 const alasan = document.getElementById("alasan");

 if(jenis==="PLT") list=dokPLT;
 else if(jenis==="PLH") list=dokPLH;
 else if(jenis==="MUTASI") list=dokMUTASI;
 else if(jenis==="REKOM_TIM") list=dokREKOM;

 list.forEach(d=>{
  document.getElementById("dokumenArea").innerHTML+=`
  <div class="dokumen">
    <b>${d}</b>
    <input type="file" name="dokumen[]">
  </div>`;
 });
}

function aturTampilanTanggal(){
 document.getElementById("areaTanggal").style.display =
 (document.getElementById("jenis").value==="PLT")?"none":"block";
}

function aturEselon(){
 document.getElementById("areaEselon").style.display =
 (document.getElementById("jenis").value==="REKOM_TIM")?"none":"block";
}

function aturNamaJabatan(){
 document.getElementById("areaNamaJabatan").style.display =
 (document.getElementById("jenis").value==="PLT"||document.getElementById("jenis").value==="MUTASI")?"block":"none";
}

function cekPenandatangan(){
 const eselon = document.getElementById("eselon").value;
 document.getElementById("ttd").innerText =
 eselon.includes("II")?"Bupati Karawang":
 eselon.includes("III")?"Sekretaris Daerah":
 eselon?"Kepala BKPSDM":"-";
}

function tampilPenandatangan(){
 document.getElementById("ttd").innerText =
 document.getElementById("penandatangan").value||"-";
}

function hitungDurasi(){
 const mulai = document.getElementById("tglMulai").value;
 const selesai = document.getElementById("tglSelesai").value;
 if(!mulai||!selesai)return;
 document.getElementById("durasi").innerText =
 (new Date(selesai)-new Date(mulai))/86400000+1;
}

function peringatanDinasLuar(){
 if(document.getElementById("alasan").value==="Penugasan Luar")
  alert("Sesuai PP 94 Tahun 2021");
}

function aturPLH(){
 let meninggal=[...document.getElementById("alasan").options].find(o=>o.text==="Meninggal Dunia");
 let cuti=[...document.getElementById("alasan").options].find(o=>o.text==="Cuti");
 const jenis = document.getElementById("jenis").value;

 if(jenis==="PLH"){
  if(meninggal) meninggal.style.display="none";
  if(!cuti){
   let o=document.createElement("option");
   o.text="Cuti";
   document.getElementById("alasan").appendChild(o);
  }
 }else{
  if(meninggal) meninggal.style.display="block";
  if(cuti) cuti.remove();
 }
}

function aturLabelTanggal(){
 document.getElementById("labelMulai").innerText="Tanggal Mulai Penugasan";
 document.getElementById("labelSelesai").innerText="Tanggal Selesai Penugasan";
}

document.addEventListener("change",()=>{
 const files=document.querySelectorAll("#dokumenArea input[type=file]");
 document.getElementById("kirim").disabled =
 files.length===0 || [...files].some(f=>!f.files.length);
});

/* ======= NOTIFIKASI BARU (TANPA MENGUBAH KODE LAMA) ======= */
document.getElementById("kirim").addEventListener("click", function(){
 const fileInputs = document.querySelectorAll("#dokumenArea input[type='file']");
 const semuaTerisi = [...fileInputs].every(input => input.files.length > 0);

 if(semuaTerisi){
  alert("✅ Usulan berhasil dikirim! Semua dokumen wajib sudah lengkap dan terupload.");
 }
});
