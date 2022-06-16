<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<style>
/* .UpperContainer {
    display: flex;
    flex-direction: row;
    align-content: space-between;
    align-items: baseline;
    justify-content: space-between;
    flex-wrap: nowrap;
} */

/* 

.MiddleContainer{
    padding-top:5%;
    display: flex;
    flex-direction: column;
    align-content: space-between;
    justify-content: space-between;
    flex-wrap: nowrap;
}

.MiddleContainerDetail{
    padding-top:1%;
    padding-bottom:1%;
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    flex-wrap: nowrap;
    flex-basis: 0;
}


.CenterMiddleContainerDetail{
    flex: 4;
    text-align: center;
} */

.UpperContainer:after {
  content: "";
  display: table;
  clear: both;
}
.X{
    float:left;
    width:33.3%;
    text-align: center;
}
.MiddleContainerDetail:after{
    content: "";
  display: table;
  clear: both;
}
.CenterMiddleContainerDetail{
    float:left;
    width:33.3%;
}
.MiddleContainer{
    padding-top:1%;
    padding-bottom:1%;
}
.MiddleContainerDetail{
    padding-top:1%;
    padding-bottom:1%;
    text-align: center;
}
</style>

<body>

    <div class="container">
        <center>
            <h4>Warranty</h4>
        </center>
        <br />
        
        @php $i=1 @endphp
                @foreach($Warranty as $p)
        <div class="MainContainer">
            <div class="UpperContainer">
                    <div class="border X">
                        <div>{{$p->tblitemwarrant_SN}}</div>
                    </div>
                    <div class="border X">
                        <div>{{$p->tblitemwarrant_dokBukti}}</div>
                    </div>
                    <div class="border X">
                        <div>{{$p->tblitemwarrant_distributor}}</div>
                    </div>
            </div>
            <div class="MiddleContainer">
                        <div  class="MiddleContainerDetail border">
                          <div class="CenterMiddleContainerDetail"><p>Pemakai</p></div>
                          <div class="CenterMiddleContainerDetail">:</div>
                          <div class="CenterMiddleContainerDetail"><p>{{$p->tblitemwarrant_username}}</p></div>
                        </div>
                        <div  class="MiddleContainerDetail border">
                            <div class="CenterMiddleContainerDetail"> <p>Tanggal Pembelian</p></div>
                          <div class="CenterMiddleContainerDetail">:</div>
                          <div class="CenterMiddleContainerDetail"><p>{{date('d-m-Y', strtotime($p->tblitemwarrant_purchaseDate))}}</p>
                          </div>
                        </div>
                        <div  class="MiddleContainerDetail border">
                            <div class="CenterMiddleContainerDetail"> <p>Tanggal Berakhir</p></div>
                          <div class="CenterMiddleContainerDetail">:</div>
                          <div class="CenterMiddleContainerDetail"><p>{{date('d-m-Y', strtotime(\Carbon\Carbon::parse($p->tblitemwarrant_purchaseDate)->addMonth($p->tblitemwarrant_monthPeriod)))}}</p>
                          </div>
                        </div>
                        <div  class="MiddleContainerDetail border">
                        <div class="CenterMiddleContainerDetail"><p>Kategori</p></div>
                          <div class="CenterMiddleContainerDetail">:</div>
                          <div class="CenterMiddleContainerDetail"><p>{{$p->tblitemcategory_name}}</p></div>
                        </div>
                        <div  class="MiddleContainerDetail border">
                        <div class="CenterMiddleContainerDetail"><p>Merek</p></div>
                          <div class="CenterMiddleContainerDetail">:</div>
                          <div class="CenterMiddleContainerDetail"><p>{{$p->tblitembrand_name}}</p></div>
                        </div>
                        <div  class="MiddleContainerDetail border">
                        <div class="CenterMiddleContainerDetail"><p>Kode Model</p></div>
                          <div class="CenterMiddleContainerDetail">:</div>
                          <div class="CenterMiddleContainerDetail"><p>{{$p->tblitemmodel_codeModel}}</p></div>
                        </div>
                        <div  class="MiddleContainerDetail border">
                        <div class="CenterMiddleContainerDetail"><p>Deskripsi Model</p></div>
                          <div class="CenterMiddleContainerDetail">:</div>
                          <div class="CenterMiddleContainerDetail"><p>{{$p->tblitemmodel_descriptionModel}}</p></div>
                        </div>
                        
                
                    </div>
        </div>
       

        @endforeach
    </div>

</body>

</html>
