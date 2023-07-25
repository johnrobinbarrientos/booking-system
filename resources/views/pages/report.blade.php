<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report template</title>
</head>
<style>
    
.report-head{
    display: flex;
    width: 100%; /* 793px;*/
    margin-left: auto;
    margin-right: auto;
    justify-content: space-between;
}
.contact-details{
    list-style: none;
    font-size: 20px;
}
.contact-details li{
    padding: 10px;
    padding-bottom: 0;
    font-size: 18px;
}
.left-col{
    text-align: left;
    float: left;
    width: 40%;
}
.right-col{
    /*float: right;*/
}
.report-title{
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
}
.report-title h2{
    text-decoration: underline;
    text-align: left;
}
.report-body{
    width: 98%;
    margin-left: auto;
    margin-right: auto;
    text-align: justify;
}
.strong-name{
    font-weight: 800;
    text-decoration: underline;
}
.report-footer{
    width: 100%;
    margin-left: auto;
    margin-right: auto;
}
.report-footer p{
    margin: 5px;
}
</style>
<body>
    <div class="report-head">
        <div class="left-col">
            <img src="{{$logo_path}}" alt="" style="width:200px;">
            <p class="abn-input">ABN: 53 604 280 248</p>
            <p>Date: {{ Carbon\Carbon::now()->format('jS F Y') }}</p>
        </div>
        <div class="right-col">
            <ul class="contact-details">
                <li><strong>Office:</strong> PO Box 295
                    Kwinana WA 6966
                    WA 6516</li>
                <li><strong>Phone:</strong> 9452 7844</li>
                <li><strong>Email:</strong> joe.b@rowlandcontractors.com.au</li>
            </ul>
        </div>
    </div>
    <div class="report-title">
        <h2>RE: CONCRETE PIPELINE THICKNESS TESTING - ESSER TWIN WALL PIPES – {{$pump->make}}&nbsp;{{$pump->plant_number}}&nbsp;{{$pump->registration}}</h2>
    </div>
    <div class="report-body">
        <p>To Whom it May Concern:</p>
        <p>Rowland Contractors currently use a specific concrete pipeline on all machinery. The Pipeline is manufactured
            from a specialized high density, high pressure twin wall material known as Esser-Werke Twinpipe.</p>
        <p>This type of pipeline construction has two layers of pipe within its pipeline giving the product as extensive
            lifetime expectancy of 100,000 cubic metres capacity. There is a letter attached from the manufacturer
            explaining in detail the properties of the product and the testing recommendations associated. For
            reference, Rowland Contractors use the product Esser Twincast 900 on all machinery.</p>
        <p>As per manufacturer literature, ultra sonic testing can not be performed for the first 50% of the pipeline
            lifetime as the test will not penetrate both layers of materials to give an accurate reading. As a result
            Rowland Contractors keep an accurate record of all concrete cubic metres that pass through the pipeline of
            every machine. Along with an accurate record, Rowland Contractors rotate each pipeline clockwise at 90
            Degree intervals between each 15,000m3 - 20,000m3 during the life of the pipeline to visually inspect each
            pipe and ensure the wearing of the pipeline is even around the entire circumference of each pipeline. Once a
            total of 75,000m3 has passed through the pipeline, Rowland Contractors discard the pipeline deeming it
            complete of its life expectancy and replace it with a complete new one.</p>
        <p>The <span class="strong-name">{{ $pump->make ?? ''}} {{$pump->plant_number}} {{$pump->registration}}</span> has had a total <span class="strong-name">

                {{ $total_metres_pumped }}

                cubic metres
            </span> passed through it as of <span>{{ Carbon\Carbon::now()->format('jS F Y') }}
            </span>. If you have any queries regarding any of
            the above information or would like to discuss anything inparticular, please do not hesitate to call.</p>
        <p>Yours Sincerely</p>
    </div>
    <div class="report-footer">
        <img src="{{$sign_path}}" alt="">
        <p>Joe Benfatta</p>
        <p> Rowland Contractors</p>
        <p>0481 154 712</p>
    </div>
</body>

</html>
