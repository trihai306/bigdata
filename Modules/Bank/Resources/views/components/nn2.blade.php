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
                                  <label for="nn2-order-number" class="form-label">Order Number:</label>
                                  <input type="text" class="form-control" value="US1091962218" id="nn2-order-number"
                                         placeholder="Order Number...">
                              </div>
                              <div class="mb-3">
                                  <label for="nn2-recipient" class="form-label">Recipient:</label>
                                  <input type="text" class="form-control" value="H Ha Nie" id="nn2-recipient"
                                         placeholder="Recipient...">
                              </div>
                              <div class="mb-3">
                                  <label for="nn2-amount" class="form-label">Amount:</label>
                                  <input type="text" class="form-control" value="2,999.00" id="nn2-amount"
                                         placeholder="Amount...">
                              </div>
                              <div class="mb-3">
                                  <label for="nn2-date-submitted" class="form-label">Date Submitted:</label>
                                  <input type="text" class="form-control"
                                         value="{{ \Carbon\Carbon::now()->format('M d') }}"
                                         id="nn2-date-submitted" placeholder="Date Submitted...">
                              </div>
                              <div class="mb-3">
                                  <label for="nn2-is-on-its-way" class="form-label">Date is on its way:</label>
                                  <input type="text" class="form-control"
                                         value="{{ \Carbon\Carbon::now()->format('M d') }}"
                                         id="nn2-is-on-its-way" placeholder="Date is on its way...">
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
                                  <img src="{{ asset('assets/banks/demo-nn2.jpg') }}" style="width: 300px" alt="">
                                  <div class="col-md-6 d-none">
                                      <canvas id="myCanvasNN2" style="width: 100%;height: 100%"></canvas>
                                      <div class="d-none">
                                          <canvas id="myCanvasNN2-real" style="display: none;"></canvas>
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
            const canvas = new fabric.Canvas('myCanvasNN2');
            canvas.setHeight(1975 / 4);
            canvas.setWidth(955 / 4);
            const orderNumberInput = document.getElementById('nn2-order-number');
            const recipientInput = document.getElementById('nn2-recipient');
            const amountInput = document.getElementById('nn2-amount');
            const dateSubmittedInput = document.getElementById('nn2-date-submitted');
            const dateIsOnItsWayInput = document.getElementById('nn2-is-on-its-way');
            const fontFamily = 'Montserrat';
            const fontSize = 11.25;
            const fill = '#5f697b';
            // Prepare the text objects without initial text
            const orderNumber = new fabric.Text('', {
                left: 224,
                top: 114,
                fill,
                fontWeight: '400',
                fontSize,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const recipient = new fabric.Text('', {
                left: 224,
                top: 196,
                fill,
                fontWeight: '400',
                fontSize,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const amount = new fabric.Text('', {
                left: 224,
                top: 220,
                fill,
                fontWeight: '400',
                fontSize,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const dateSubmitted = new fabric.Text('', {
                left: 224,
                top: 258,
                fill,
                fontWeight: '400',
                fontSize,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const dateIsOnItsWay = new fabric.Text('', {
                left: 224,
                top: 312,
                fill,
                fontWeight: '400',
                fontSize,
                originX: 'right',
                fontFamily,
                selectable: false,
            });

            function updateOrderNumber() {
                const newValue = orderNumberInput.value;
                orderNumber.set({text: newValue});
                canvas.renderAll(); // Re-render the canvas để hiển thị thay đổi
            }

            function updateRecipient() {
                const newValue = recipientInput.value;
                recipient.set({text: newValue});
                canvas.renderAll();
            }

            function updateAmount() {
                const newValue = amountInput.value;
                amount.set({text: `${newValue} USD`});
                canvas.renderAll();
            }

            function updateDateSubmitted() {
                const text = dateSubmittedInput.value;
                dateSubmitted.set({text});
                canvas.renderAll();
            }

            function updateIsOnItsWay() {
                const text = dateIsOnItsWayInput.value;
                dateIsOnItsWay.set({text});
                canvas.renderAll();
            }

            orderNumberInput.addEventListener('input', updateOrderNumber);
            recipientInput.addEventListener('input', updateRecipient);
            amountInput.addEventListener('input', updateAmount);
            dateSubmittedInput.addEventListener('input', updateDateSubmitted);
            dateIsOnItsWayInput.addEventListener('input', updateIsOnItsWay);

            //trigger event to show info
            const eventTrigger = new Event('input', {
                bubbles: true,
                cancelable: true,
            });
            orderNumberInput.dispatchEvent(eventTrigger);
            recipientInput.dispatchEvent(eventTrigger);
            amountInput.dispatchEvent(eventTrigger);
            dateSubmittedInput.dispatchEvent(eventTrigger);
            dateIsOnItsWayInput.dispatchEvent(eventTrigger);
            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/nn2.jpg')}}', function (oImg) {
                oImg.scaleToWidth(canvas.getWidth());
                oImg.scaleToHeight(canvas.getHeight());
                oImg.selectable = false;
                canvas.add(oImg);

                // Add the text objects to the canvas
                canvas.add(orderNumber);
                canvas.add(recipient);
                canvas.add(amount);
                canvas.add(dateSubmitted);
                canvas.add(dateIsOnItsWay);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvas = new fabric.Canvas('myCanvasNN2-real');
            canvas.setHeight(1975);
            canvas.setWidth(955);
            const orderNumberInput = document.getElementById('nn2-order-number');
            const recipientInput = document.getElementById('nn2-recipient');
            const amountInput = document.getElementById('nn2-amount');
            const dateSubmittedInput = document.getElementById('nn2-date-submitted');
            const dateIsOnItsWayInput = document.getElementById('nn2-is-on-its-way');
            const fontFamily = 'Montserrat';
            const fill = '#5f697b';
            const fontSize = 11.25;
            // Prepare the text objects without initial text

            const orderNumber = new fabric.Text('', {
                left: 224 * 4,
                top: 114 * 4,
                fill,
                fontWeight: '400',
                fontSize: fontSize * 4,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const recipient = new fabric.Text('', {
                left: 224 * 4,
                top: 196 * 4,
                fill,
                fontWeight: '400',
                fontSize: fontSize * 4,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const amount = new fabric.Text('', {
                left: 224 * 4,
                top: 220 * 4,
                fill,
                fontWeight: '400',
                fontSize: fontSize * 4,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const dateSubmitted = new fabric.Text('', {
                left: 224 * 4,
                top: 258 * 4,
                fill,
                fontWeight: '400',
                fontSize: fontSize * 4,
                originX: 'right',
                fontFamily,
                selectable: false,
            });
            const dateIsOnItsWay = new fabric.Text('', {
                left: 224 * 4,
                top: 312 * 4,
                fill,
                fontWeight: '400',
                fontSize: fontSize * 4,
                originX: 'right',
                fontFamily,
                selectable: false,
            });

            function updateOrderNumber() {
                const newValue = orderNumberInput.value;
                orderNumber.set({text: newValue});
                canvas.renderAll(); // Re-render the canvas để hiển thị thay đổi
            }

            function updateRecipient() {
                const newValue = recipientInput.value;
                recipient.set({text: newValue});
                canvas.renderAll();
            }

            function updateAmount() {
                const newValue = amountInput.value;
                amount.set({text: `${newValue} USD`});
                canvas.renderAll();
            }

            function updateDateSubmitted() {
                const text = dateSubmittedInput.value;
                dateSubmitted.set({text});
                canvas.renderAll();
            }

            function updateIsOnItsWay() {
                const text = dateIsOnItsWayInput.value;
                dateIsOnItsWay.set({text});
                canvas.renderAll();
            }

            orderNumberInput.addEventListener('input', updateOrderNumber);
            recipientInput.addEventListener('input', updateRecipient);
            amountInput.addEventListener('input', updateAmount);
            dateSubmittedInput.addEventListener('input', updateDateSubmitted);
            dateIsOnItsWayInput.addEventListener('input', updateIsOnItsWay);

            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/nn2.jpg')}}', function (oImg) {
                oImg.scaleToWidth(canvas.getWidth());
                oImg.scaleToHeight(canvas.getHeight());
                oImg.selectable = false;
                canvas.add(oImg);

                // Add the text objects to the canvas
                canvas.add(orderNumber);
                canvas.add(recipient);
                canvas.add(amount);
                canvas.add(dateSubmitted);
                canvas.add(dateIsOnItsWay);
            });

            Livewire.on('download-image', (event) => {
                const dataURL = canvas.toDataURL({
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
