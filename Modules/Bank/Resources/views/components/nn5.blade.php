@extends('future::layouts.app')
@section('content')
 <div class="card">
     <div class="card-body">
         <div class="content flex-row-fluid">
             <div class="row">
                 <div class="col-md-6 col-sm-12">
                     <div class="card">
                         <div class="card-body">
                             <div class="mb-3 mt-3">
                                 <label for="nn5-withdraw" class="form-label">Withdraw:</label>
                                 <input type="text" class="form-control"
                                        value="USDT (ERC20)" id="nn5-withdraw"
                                        placeholder="Withdraw...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn5-date" class="form-label">Date:</label>
                                 <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::now()->format('M d, Y \a\t H:i A') }}" id="nn5-date"
                                        placeholder="Date...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn5-value1" class="form-label">Value 1:</label>
                                 <input type="text" class="form-control"
                                        value="5,029.76" id="nn5-value1"
                                        placeholder="Value 1...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn5-value2" class="form-label">Value 2:</label>
                                 <input type="text" class="form-control"
                                        value="5,029.76" id="nn5-value2"
                                        placeholder="Value 2...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn5-sending" class="form-label">Sending:</label>
                                 <input type="text" class="form-control"
                                        value="5,014.76" id="nn5-sending"
                                        placeholder="Sending...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn5-withdraw-to" class="form-label">Withdraw to:</label>
                                 <input type="text" class="form-control"
                                        value="Oxd66F5865e415D92eF3d4658d09bC859E67a5B699" id="nn5-withdraw-to"
                                        placeholder="Withdraw to...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn5-network" class="form-label">Network Type:</label>
                                 <input type="text" class="form-control"
                                        value="ERC20" id="nn5-network"
                                        placeholder="Network Type...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn5-fee" class="form-label">Fee:</label>
                                 <input type="text" class="form-control"
                                        value="15.00" id="nn5-fee"
                                        placeholder="Total...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn5-total" class="form-label">Total:</label>
                                 <input type="text" class="form-control"
                                        value="5,029.76" id="nn5-total"
                                        placeholder="Total...">
                             </div>
                             <div class="mb-3">
                                 <livewire:bank::download-image />
                             </div>
                         </div>
                     </div>

                 </div>
                 <div class="col-md-6 col-sm-12 mt-sm-2">
                     <div class="card">
                         <div class="card-body">
                             <div class="row">
                                 <img src="{{ asset('assets/banks/demo-nn5.png') }}" style="width: 300px" alt="">
                                 <div class="col-md-6 d-none">
                                     <canvas id="myCanvasNN5" style="width: 100%;height: 100%"></canvas>
                                     <div class="d-none">
                                         <canvas id="myCanvasNN5-real" style="display: none;"></canvas>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvasReal = new fabric.Canvas('myCanvasNN5-real');
            const canvas = new fabric.Canvas('myCanvasNN5');
            const imageWidth = 591;
            const imageHeight = 1280;
            const ratio = 1.25;
            canvas.setWidth(imageWidth / ratio);
            canvas.setHeight(imageHeight / ratio);
            canvasReal.setWidth(imageWidth);
            canvasReal.setHeight(imageHeight);
            const withdrawInput = document.getElementById('nn5-withdraw');
            const dateInput = document.getElementById('nn5-date');
            const value1Input = document.getElementById('nn5-value1');
            const value2Input = document.getElementById('nn5-value2');
            const sendingInput = document.getElementById('nn5-sending');
            const withdrawToInput = document.getElementById('nn5-withdraw-to');
            const networkInput = document.getElementById('nn5-network');
            const feeInput = document.getElementById('nn5-fee');
            const totalInput = document.getElementById('nn5-total');

            const fontFamily = 'Inter';
            // Prepare the text objects without initial text
            const withdraw = new fabric.Textbox('', {
                left: 200 / ratio,
                top: 195 / ratio,
                fill: '#f9fcfc',
                fontWeight: '600',
                fontSize: 35 / ratio,
                fontFamily,
                selectable: false,
                width: 350 / ratio,
                splitByGrapheme: true,
            });
            const withdrawReal = new fabric.Textbox('', {
                left: 200,
                top: 195,
                fill: '#f9fcfc',
                fontWeight: '600',
                fontSize: 35,
                fontFamily,
                selectable: false,
                width: 350,
                splitByGrapheme: true,
            });
            const date = new fabric.Text('', {
                left: 26 / ratio,
                top: 350 / ratio,
                fill: '#f9fcfc',
                fontWeight: '400',
                fontSize: 24 / ratio,
                fontFamily,
                selectable: false,
            });
            const value1 = new fabric.Text('', {
                left: 30 / ratio,
                top: 500 / ratio,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 60 / ratio,
                fontFamily,
                selectable: false,
            });
            const value2 = new fabric.Text('', {
                left: 58 / ratio,
                top: 630 / ratio,
                fill: '#212123',
                fontWeight: '600',
                fontSize: 20 / ratio,
                fontFamily,
                selectable: false,
            });
            const value1Real = new fabric.Text('', {
                left: 30,
                top: 500,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 60,
                fontFamily,
                selectable: false,
            });
            const value2Real = new fabric.Text('', {
                left: 58,
                top: 630,
                fill: '#212123',
                fontWeight: '600',
                fontSize: 20,
                fontFamily,
                selectable: false,
            });
            const dateReal = new fabric.Text('', {
                left: 26,
                top: 350,
                fill: '#f9fcfc',
                fontWeight: '600',
                fontSize: 24,
                fontFamily,
                selectable: false,
            });
            const sending = new fabric.Text('', {
                left: 500 / ratio,
                top: 790 / ratio,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 24 / ratio,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const withDrawTo = new fabric.Textbox('', {
                left: 567 / ratio,
                top: 870 / ratio,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 24 / ratio,
                originX: 'right',
                originY: 'center',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 368 / ratio,
                splitByGrapheme: true,
            });
            const withDrawToReal = new fabric.Textbox('', {
                left: 567,
                top: 870,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 24,
                originX: 'right',
                originY: 'center',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 368,
                splitByGrapheme: true,
            });
            const sendingReal = new fabric.Text('', {
                left: 500,
                top: 790,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 24,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const network = new fabric.Text('', {
                left: 567 / ratio,
                top: 919 / ratio,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 25 / ratio,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const networkReal = new fabric.Text('', {
                left: 567,
                top: 919,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 25,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const fee = new fabric.Text('', {
                left: 500 / ratio,
                top: 972 / ratio,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 24 / ratio,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const feeReal = new fabric.Text('', {
                left: 500,
                top: 972,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 24,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const total = new fabric.Text('', {
                left: 500 / ratio,
                top: 1023 / ratio,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 24 / ratio,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const totalReal = new fabric.Text('', {
                left: 500,
                top: 1023,
                fill: '#212123',
                fontWeight: '400',
                fontSize: 24,
                originX: 'right',
                fontFamily,
                selectable: false,
            });

            withdrawInput.addEventListener('input', ev => {
                withdraw.set({text: ev.currentTarget.value})
                withdrawReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });

            sendingInput.addEventListener('input', ev => {
                sending.set({text: ev.currentTarget.value})
                sendingReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            value1Input.addEventListener('input', ev => {
                value1.set({text: ev.currentTarget.value})
                value1Real.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            value2Input.addEventListener('input', ev => {
                value2.set({text: ev.currentTarget.value})
                value2Real.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });

            withdrawToInput.addEventListener('input', ev => {
                withDrawTo.set({text: ev.currentTarget.value})
                withDrawToReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });

            dateInput.addEventListener('input', ev => {
                date.set({text: ev.currentTarget.value})
                dateReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });

            feeInput.addEventListener('input', ev => {
                fee.set({text: ev.currentTarget.value})
                feeReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            totalInput.addEventListener('input', ev => {
                total.set({text: ev.currentTarget.value})
                totalReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            networkInput.addEventListener('input', ev => {
                network.set({text: ev.currentTarget.value})
                networkReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            const eventTrigger = new Event('input', {
                bubbles: true,
                cancelable: true,
            });
            withdrawInput.dispatchEvent(eventTrigger);
            dateInput.dispatchEvent(eventTrigger);
            feeInput.dispatchEvent(eventTrigger);
            totalInput.dispatchEvent(eventTrigger);
            networkInput.dispatchEvent(eventTrigger);
            sendingInput.dispatchEvent(eventTrigger);
            withdrawToInput.dispatchEvent(eventTrigger);
            value1Input.dispatchEvent(eventTrigger);
            value2Input.dispatchEvent(eventTrigger);

            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/nn5.jpg')}}', function (oImg) {
                oImg.scaleToWidth(canvas.getWidth());
                oImg.scaleToHeight(canvas.getHeight());
                oImg.selectable = false;
                canvas.add(oImg);

                // Add the text objects to the canvas
                canvas.add(withdraw);
                canvas.add(date);
                canvas.add(value1);
                canvas.add(value2);
                canvas.add(sending);
                canvas.add(withDrawTo);
                canvas.add(network);
                canvas.add(fee);
                canvas.add(total);
            });
            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/nn5.jpg')}}', function (oImg) {
                oImg.scaleToWidth(canvasReal.getWidth());
                oImg.scaleToHeight(canvasReal.getHeight());
                oImg.selectable = false;
                canvasReal.add(oImg);

                // Add the text objects to the canvas
                canvasReal.add(withdrawReal);
                canvasReal.add(dateReal);
                canvasReal.add(value1Real);
                canvasReal.add(value2Real);
                canvasReal.add(sendingReal);
                canvasReal.add(withDrawToReal);
                canvasReal.add(networkReal);
                canvasReal.add(feeReal);
                canvasReal.add(totalReal);

            });
            Livewire.on('download-image', (event) => {
                canvasReal.renderAll();
                const dataURL = canvasReal.toDataURL({
                    format: 'png',
                    quality: 1
                });

                const downloadLink = document.createElement('a');
                downloadLink.href = dataURL;
                downloadLink.download = 'custom-image.png';

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            });
        });
    </script>
@endsection
