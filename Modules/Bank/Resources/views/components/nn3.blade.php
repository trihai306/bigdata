@extends('core::layouts.master')
@section('content')
    <div class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 mt-3">
                                <label for="nn3-country" class="form-label">Country:</label>
                                <select id="nn3-country" class="form-control">
                                    <option value="{{ asset('assets/banks/flags/16.png') }}">16</option>
                                    <option value="{{ asset('assets/banks/flags/25.png') }}">25</option>
                                    <option value="{{ asset('assets/banks/flags/30.png') }}">30</option>
                                    <option value="{{ asset('assets/banks/flags/31.png') }}">31</option>
                                    <option value="{{ asset('assets/banks/flags/32.png') }}">32</option>
                                    <option value="{{ asset('assets/banks/flags/33.png') }}">33</option>
                                    <option value="{{ asset('assets/banks/flags/34.png') }}">34</option>
                                    <option value="{{ asset('assets/banks/flags/35.png') }}">35</option>
                                    <option value="{{ asset('assets/banks/flags/36.png') }}">36</option>
                                    <option value="{{ asset('assets/banks/flags/38.png') }}">38</option>
                                    <option value="{{ asset('assets/banks/flags/39.png') }}">39</option>
                                    <option value="{{ asset('assets/banks/flags/40.png') }}">40</option>
                                    <option value="{{ asset('assets/banks/flags/41.png') }}">41</option>
                                </select>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-message" class="form-label">Message:</label>
                                <input type="text" class="form-control"
                                       value="You send 999.0 USD to Vu Dinh Truong" id="nn3-message"
                                       placeholder="Message...">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-bank-info" class="form-label">Bank Information:</label>
                                <input type="text" class="form-control"
                                       value="●●●8790: Vietcombank" id="nn3-bank-info"
                                       placeholder="Bank Information...">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-bank-confirm" class="form-label">Bank Confirm:</label>
                                <input type="text" class="form-control"
                                       value="Vietcombank Confirmation: BAN-230813-1W11B2" id="nn3-bank-confirm"
                                       placeholder="Bank confirm...">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-time" class="form-label">Time:</label>
                                <input type="text" class="form-control"
                                       value="{{ \Carbon\Carbon::now()->format('M d, Y \a\t H:i A') }}" id="nn3-time"
                                       placeholder="Order Number...">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-amount" class="form-label">Amount:</label>
                                <input type="text" class="form-control" value="999.00 USD" id="nn3-amount"
                                       placeholder="Amount...">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-ex-rate" class="form-label">Exchange Rate:</label>
                                <input type="text" class="form-control" value="1 USD = 23671.044320 VND"
                                       id="nn3-ex-rate"
                                       placeholder="Exchange Rate...">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-fees" class="form-label">Fees:</label>
                                <input type="text" class="form-control" value="0.00 USD" id="nn3-fees"
                                       placeholder="Fees...">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-total-paid" class="form-label">Total Paid:</label>
                                <input type="text" class="form-control" value="999.00 USD" id="nn3-total-paid"
                                       placeholder="Total Paid...">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-receive-amount" class="form-label">Receive Amount:</label>
                                <input type="text" class="form-control" value="23,647,374 VND" id="nn3-receive-amount"
                                       placeholder="Receive Amount...">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nn3-time-estimate" class="form-label">Time Estimate:</label>
                                <input type="text" class="form-control"
                                       value="{{ \Carbon\Carbon::now()->addMinutes(30)->format('M d, Y \a\t H:i A') }}"
                                       id="nn3-time-estimate"
                                       placeholder="Time Estimate...">
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
                                <img src="{{ asset('assets/banks/demo-nn3.jpg') }}" style="width: 300px" alt="">
                                <div class="col-md-6 d-none">
                                    <canvas id="myCanvasNN3" style="width: 100%;height: 100%"></canvas>
                                    <div class="d-none">
                                        <canvas id="myCanvasNN3-real"></canvas>
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
            const canvasReal = new fabric.Canvas('myCanvasNN3-real');
            const canvas = new fabric.Canvas('myCanvasNN3');
            const imageWidth = 947;
            const imageHeight = 2048;
            const ratio = 3;
            canvas.setWidth(imageWidth / ratio);
            canvas.setHeight(imageHeight / ratio);
            canvasReal.setWidth(imageWidth);
            canvasReal.setHeight(imageHeight);
            const bankInformationInput = document.getElementById('nn3-bank-info');
            const bankConfirmInput = document.getElementById('nn3-bank-confirm');
            const timeInput = document.getElementById('nn3-time');
            const amountInput = document.getElementById('nn3-amount');
            const exRateInput = document.getElementById('nn3-ex-rate');
            const feesInput = document.getElementById('nn3-fees');
            const totalPaidInput = document.getElementById('nn3-total-paid');
            const receiveAmountInput = document.getElementById('nn3-receive-amount');
            const timeEstimateInput = document.getElementById('nn3-time-estimate');
            const messageInput = document.getElementById('nn3-message');
            const countryInput = document.getElementById('nn3-country');

            const fontFamily = 'Inter';
            // Prepare the text objects without initial text
            const message = new fabric.Textbox('', {
                left: imageWidth / (ratio * 2),
                top: 610 / ratio,
                fill: '#2a3b6e',
                fontWeight: '600',
                fontSize: 35 / ratio,
                originX: 'center',
                originY: 'bottom',
                textAlign: 'center',
                fontFamily,
                selectable: false,
                width: 700 / ratio, // Thiết lập chiều rộng tối đa cho textbox
                splitByGrapheme: true,
            });
            const bankInformation = new fabric.Text('', {
                left: imageWidth / (ratio * 2),
                top: 635 / ratio,
                fill: '#2a3b6e',
                fontWeight: '600',
                fontSize: 22 / ratio,
                originX: 'center',
                fontFamily,
                selectable: false,
            });
            const bankConfirm = new fabric.Text('', {
                left: imageWidth / (ratio * 2),
                top: 680 / ratio,
                fill: '#5f697b',
                fontWeight: '400',
                fontSize: 24 / ratio,
                originX: 'center',
                fontFamily,
                selectable: false,
            });
            const timeOnTop = new fabric.Text('', {
                left: imageWidth / (ratio * 2),
                top: 220 / ratio,
                fill: '#5f697b',
                fontWeight: '300',
                fontSize: 26 / ratio,
                originX: 'center',
                fontFamily,
                selectable: false,
            });
            const sendAmount = new fabric.Text('', {
                left: 50 / ratio,
                top: 885 / ratio,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35 / ratio,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const exRate = new fabric.Text('', {
                left: 50 / ratio,
                top: 1030 / ratio,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35 / ratio,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const fees = new fabric.Text('', {
                left: 50 / ratio,
                top: 1175 / ratio,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35 / ratio,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const totalPaid = new fabric.Text('', {
                left: 50 / ratio,
                top: 1318 / ratio,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35 / ratio,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const receiveAmount = new fabric.Text('', {
                left: 50 / ratio,
                top: 1462 / ratio,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35 / ratio,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const timeEstimate = new fabric.Text('', {
                left: 50 / ratio,
                top: 1610 / ratio,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35 / ratio,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const messageReal = new fabric.Textbox('', {
                left: imageWidth / 2,
                top: 610,
                fill: '#2a3b6e',
                fontWeight: '600',
                fontSize: 35,
                originX: 'center',
                originY: 'bottom',
                textAlign: 'center',
                fontFamily,
                selectable: false,
                width: 700, // Thiết lập chiều rộng tối đa cho textbox
                splitByGrapheme: true,
            });
            const bankInformationReal = new fabric.Text('', {
                left: imageWidth / 2,
                top: 635,
                fill: '#2a3b6e',
                fontWeight: '600',
                fontSize: 22,
                originX: 'center',
                fontFamily,
                selectable: false,
            });
            const bankConfirmReal = new fabric.Text('', {
                left: imageWidth / 2,
                top: 680,
                fill: '#5f697b',
                fontWeight: '400',
                fontSize: 24,
                originX: 'center',
                fontFamily,
                selectable: false,
            });
            const timeOnTopReal = new fabric.Text('', {
                left: imageWidth / 2,
                top: 220,
                fill: '#5f697b',
                fontWeight: '300',
                fontSize: 26,
                originX: 'center',
                fontFamily,
                selectable: false,
            });
            const sendAmountReal = new fabric.Text('', {
                left: 50,
                top: 885,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const exRateReal = new fabric.Text('', {
                left: 50,
                top: 1030,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const feesReal = new fabric.Text('', {
                left: 50,
                top: 1175,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const totalPaidReal = new fabric.Text('', {
                left: 50,
                top: 1318,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const receiveAmountReal = new fabric.Text('', {
                left: 50,
                top: 1462,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35,
                originX: 'left',
                fontFamily,
                selectable: false,
            });
            const timeEstimateReal = new fabric.Text('', {
                left: 50,
                top: 1610,
                fill: '#3f4d88',
                fontWeight: '500',
                fontSize: 35,
                originX: 'left',
                fontFamily,
                selectable: false,
            });

            messageInput.addEventListener('input', ev => {
                message.set({text: ev.currentTarget.value})
                messageReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
                canvasReal.renderAll();
            });
            timeInput.addEventListener('input', ev => {
                timeOnTop.set({text: ev.currentTarget.value.toUpperCase()})
                timeOnTopReal.set({text: ev.currentTarget.value.toUpperCase()})
                canvas.renderAll();
                canvasReal.renderAll();
            });
            timeEstimateInput.addEventListener('input', ev => {
                timeEstimate.set({text: ev.currentTarget.value})
                timeEstimateReal.set({text: ev.currentTarget.value})
                canvas.renderAll();
                canvasReal.renderAll();
            })
            amountInput.addEventListener('input', ev => {
                sendAmount.set({text: ev.currentTarget.value});
                sendAmountReal.set({text: ev.currentTarget.value});
                canvas.renderAll();
                canvasReal.renderAll();
            });
            exRateInput.addEventListener('input', ev => {
                exRate.set({text: ev.currentTarget.value});
                exRateReal.set({text: ev.currentTarget.value});
                canvas.renderAll();
                canvasReal.renderAll();
            });
            feesInput.addEventListener('input', ev => {
                fees.set({text: ev.currentTarget.value});
                feesReal.set({text: ev.currentTarget.value});
                canvas.renderAll();
                canvasReal.renderAll();
            })
            totalPaidInput.addEventListener('input', ev => {
                totalPaid.set({text: ev.currentTarget.value});
                totalPaidReal.set({text: ev.currentTarget.value});
                canvas.renderAll();
                canvasReal.renderAll();
            })
            receiveAmountInput.addEventListener('input', ev => {
                receiveAmount.set({text: ev.currentTarget.value});
                receiveAmountReal.set({text: ev.currentTarget.value});
                canvas.renderAll();
                canvasReal.renderAll();
            })
            bankConfirmInput.addEventListener('input', ev => {
                bankConfirm.set({text: ev.currentTarget.value});
                bankConfirmReal.set({text: ev.currentTarget.value});
                canvas.renderAll();
                canvasReal.renderAll();
            })
            bankInformationInput.addEventListener('input', ev => {
                bankInformation.set({text: ev.currentTarget.value});
                bankInformationReal.set({text: ev.currentTarget.value});
                canvas.renderAll();
                canvasReal.renderAll();
            })

            countryInput.addEventListener('change', function (ev) {
                const pathUrl = ev.currentTarget.value;
                const objs = canvas.getObjects();
                const objsReal = canvasReal.getObjects();
                canvas.remove(objs[objs.length - 1]);
                canvasReal.remove(objsReal[objsReal.length - 1])

                fabric.Image.fromURL(pathUrl, function (oImg) {
                    canvas.add(oImg.set({
                        width: 36,
                        height: 26,
                        selectable: true,
                        left: imageWidth / (ratio * 2) - 18,
                        top: 450 / ratio,
                    }));
                });
                fabric.Image.fromURL(pathUrl, function (oImg) {
                    canvasReal.add(oImg.set({
                        width: 72,
                        height: 52,
                        selectable: true,
                        left: (imageWidth / 2) - 36,
                        top: 450,
                    }));
                });
            })
            //trigger event to show info
            const eventTrigger = new Event('input', {
                bubbles: true,
                cancelable: true,
            });
            messageInput.dispatchEvent(eventTrigger);
            timeInput.dispatchEvent(eventTrigger);
            timeEstimateInput.dispatchEvent(eventTrigger);
            amountInput.dispatchEvent(eventTrigger);
            exRateInput.dispatchEvent(eventTrigger);
            feesInput.dispatchEvent(eventTrigger);
            totalPaidInput.dispatchEvent(eventTrigger);
            receiveAmountInput.dispatchEvent(eventTrigger);
            bankConfirmInput.dispatchEvent(eventTrigger);
            bankInformationInput.dispatchEvent(eventTrigger);

            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/nn3.jpg')}}', function (oImg) {
                oImg.scaleToWidth(canvas.getWidth());
                oImg.scaleToHeight(canvas.getHeight());
                oImg.selectable = false;
                canvas.add(oImg);

                // Add the text objects to the canvas
                canvas.add(message);
                canvas.add(bankConfirm);
                canvas.add(timeOnTop);
                canvas.add(sendAmount);
                canvas.add(exRate);
                canvas.add(fees);
                canvas.add(totalPaid);
                canvas.add(receiveAmount);
                canvas.add(timeEstimate);
                canvas.add(bankInformation);
            });
            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/nn3.jpg')}}', function (oImg) {
                oImg.scaleToWidth(canvasReal.getWidth());
                oImg.scaleToHeight(canvasReal.getHeight());
                oImg.selectable = false;
                canvasReal.add(oImg);

                // Add the text objects to the canvas
                canvasReal.add(messageReal);
                canvasReal.add(bankConfirmReal);
                canvasReal.add(timeOnTopReal);
                canvasReal.add(sendAmountReal);
                canvasReal.add(exRateReal);
                canvasReal.add(feesReal);
                canvasReal.add(totalPaidReal);
                canvasReal.add(receiveAmountReal);
                canvasReal.add(timeEstimateReal);
                canvasReal.add(bankInformationReal);
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
