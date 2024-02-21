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
                                 <label for="nn4-fee" class="form-label">Fee:</label>
                                 <input type="text" class="form-control"
                                        value="+ 0.00 USD" id="nn4-fee"
                                        placeholder="Fee...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn4-ex-rate" class="form-label">Exchange Rate:</label>
                                 <input type="text" class="form-control"
                                        value="1.00 USD = 23,482.7360 VND" id="nn4-ex-rate"
                                        placeholder="Exchange Rate...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn4-total" class="form-label">Total:</label>
                                 <input type="text" class="form-control"
                                        value="1,500.00 USD" id="nn4-total"
                                        placeholder="Total...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn4-transfer-amount" class="form-label">Transfer Amount:</label>
                                 <input type="text" class="form-control"
                                        value="35,255,000.00 VND" id="nn4-transfer-amount"
                                        placeholder="Transfer Amount...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn4-total-receive" class="form-label">Total Receive:</label>
                                 <input type="text" class="form-control"
                                        value="35,255,000.00 VND" id="nn4-total-receive"
                                        placeholder="Total Receive...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn4-payment-info" class="form-label">Payment Info:</label>
                                 <input type="text" class="form-control"
                                        value="6741 07/2026" id="nn4-payment-info"
                                        placeholder="Payment Info...">
                             </div>
                             <div class="mb-3 mt-3">
                                 <label for="nn4-account-number" class="form-label">Account Number:</label>
                                 <input type="text" class="form-control"
                                        value="XXXXXX2079" id="nn4-account-number"
                                        placeholder="Account Number:...">
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
                                 <img src="{{ asset('assets/banks/demo-nn4.jpg') }}" style="width: 300px" alt="">
                                 <div class="col-md-6 d-none">
                                     <canvas id="myCanvasNN4" style="width: 100%;height: 100%"></canvas>
                                     <div class="d-none">
                                         <canvas id="myCanvasNN4-real" style="display: none;"></canvas>
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
            const canvasReal = new fabric.Canvas('myCanvasNN4-real');
            const canvas = new fabric.Canvas('myCanvasNN4');
            const imageWidth = 955;
            const imageHeight = 1982;
            const ratio = 2;
            canvas.setWidth(imageWidth / ratio);
            canvas.setHeight(imageHeight / ratio);
            canvasReal.setWidth(imageWidth);
            canvasReal.setHeight(imageHeight);
            const feeInput = document.getElementById('nn4-fee');
            const totalInput = document.getElementById('nn4-total');
            const exchangeRateInput = document.getElementById('nn4-ex-rate');
            const transferAmountInput = document.getElementById('nn4-transfer-amount');
            const totalReceiveInput = document.getElementById('nn4-total-receive');
            const accountNumberInput = document.getElementById('nn4-account-number');
            const paymentInfoInput = document.getElementById('nn4-payment-info');

            const fontFamily = 'Inter';
            // Prepare the text objects without initial text
            const fee = new fabric.Text('', {
                left: 910 / ratio,
                top: 298 / ratio,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35 / ratio,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const feeReal = new fabric.Text('', {
                left: 910,
                top: 298,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const total = new fabric.Text('', {
                left: 910 / ratio,
                top: 378 / ratio,
                fill: '#586d7b',
                fontWeight: '600',
                fontSize: 35 / ratio,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const totalReal = new fabric.Text('', {
                left: 910,
                top: 378,
                fill: '#586d7b',
                fontWeight: '600',
                fontSize: 35,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const exchangeRate = new fabric.Textbox('', {
                left: 910 / ratio,
                top: 465 / ratio,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35 / ratio,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420 / ratio, // Thiết lập chiều rộng tối đa cho textbox
                splitByGrapheme: true,
            });
            const exchangeRateReal = new fabric.Textbox('', {
                left: 910,
                top: 465,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420, // Thiết lập chiều rộng tối đa cho textbox
                splitByGrapheme: true,
            });
            const transferAmount = new fabric.Textbox('', {
                left: 910 / ratio,
                top: 595 / ratio,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35 / ratio,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420 / ratio,
                splitByGrapheme: true,
            });
            const transferAmountReal = new fabric.Textbox('', {
                left: 910,
                top: 595,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420,
                splitByGrapheme: true,
            });
            const totalReceive = new fabric.Textbox('', {
                left: 910 / ratio,
                top: 680 / ratio,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35 / ratio,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420 / ratio,
                splitByGrapheme: true,
            });
            const totalReceiveReal = new fabric.Textbox('', {
                left: 910,
                top: 680,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420,
                splitByGrapheme: true,
            });
            const accountNumber = new fabric.Textbox('', {
                left: 910 / ratio,
                top: 1350 / ratio,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35 / ratio,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420 / ratio,
                splitByGrapheme: true,
            });
            const accountNumberReal = new fabric.Textbox('', {
                left: 910,
                top: 1350,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420,
                splitByGrapheme: true,
            });
            const paymentInfo = new fabric.Textbox('', {
                left: 910 / ratio,
                top: 810 / ratio,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35 / ratio,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420 / ratio,
                splitByGrapheme: true,
            });
            const paymentInfoReal = new fabric.Textbox('', {
                left: 910,
                top: 810,
                fill: '#3e4340',
                fontWeight: '600',
                fontSize: 35,
                originX: 'right',
                textAlign: 'right',
                fontFamily,
                selectable: false,
                width: 420,
                splitByGrapheme: true,
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
            exchangeRateInput.addEventListener('input', ev => {
                exchangeRate.set({text: ev.currentTarget.value})
                exchangeRateReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            transferAmountInput.addEventListener('input', ev => {
                transferAmount.set({text: ev.currentTarget.value})
                transferAmountReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            totalReceiveInput.addEventListener('input', ev => {
                totalReceive.set({text: ev.currentTarget.value})
                totalReceiveReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            accountNumberInput.addEventListener('input', ev => {
                accountNumber.set({text: ev.currentTarget.value})
                accountNumberReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            paymentInfoInput.addEventListener('input', ev => {
                paymentInfo.set({text: ev.currentTarget.value})
                paymentInfoReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
            });
            const eventTrigger = new Event('input', {
                bubbles: true,
                cancelable: true,
            });
            feeInput.dispatchEvent(eventTrigger);
            totalInput.dispatchEvent(eventTrigger);
            exchangeRateInput.dispatchEvent(eventTrigger);
            transferAmountInput.dispatchEvent(eventTrigger);
            totalReceiveInput.dispatchEvent(eventTrigger);
            accountNumberInput.dispatchEvent(eventTrigger);
            paymentInfoInput.dispatchEvent(eventTrigger);
            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/nn4.jpg')}}', function (oImg) {
                oImg.scaleToWidth(canvas.getWidth());
                oImg.scaleToHeight(canvas.getHeight());
                oImg.selectable = false;
                canvas.add(oImg);

                // Add the text objects to the canvas
                canvas.add(fee);
                canvas.add(total);
                canvas.add(exchangeRate);
                canvas.add(transferAmount);
                canvas.add(totalReceive);
                canvas.add(accountNumber);
                canvas.add(paymentInfo);
            });
            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/nn4.jpg')}}', function (oImg) {
                oImg.scaleToWidth(canvasReal.getWidth());
                oImg.scaleToHeight(canvasReal.getHeight());
                oImg.selectable = false;
                canvasReal.add(oImg);

                // Add the text objects to the canvas
                canvasReal.add(feeReal);
                canvasReal.add(totalReal);
                canvasReal.add(exchangeRateReal);
                canvasReal.add(transferAmountReal);
                canvasReal.add(totalReceiveReal);
                canvasReal.add(accountNumberReal);
                canvasReal.add(paymentInfoReal);
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
