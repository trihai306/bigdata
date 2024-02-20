@extends('future::layouts.app')
@section('content')
   <div class="card">
       <div class="content flex-row-fluid">
           <div class="row">
               <div class="col-md-6 col-sm-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="mb-3 mt-3">
                               <label for="name" class="form-label">Tên người nhận:</label>
                               <input type="text" class="form-control" value="Tran, Nhi Huu" id="name"
                                      placeholder="Nhập tên" name="name">
                           </div>
                           <div class="mb-3">
                               <label for="money" class="form-label">Nhập số tiền:</label>
                               <input type="text" class="form-control" value="1,000.00" id="money"
                                      placeholder="Nhập số tiền" name="money">
                           </div>
                           <div class="mb-3">
                               <label for="money" class="form-label">Nhập số tiền VNĐ:</label>
                               <input type="text" class="form-control" value="24,061,480.00" id="money_vnd"
                                      placeholder="Nhập số tiền" name="money_vnd">
                           </div>
                           <div class="mb-3">
                               <label for="money" class="form-label">Nhập số tiền Mã Code:</label>
                               <input type="text" class="form-control" value="R123123213121" id="code"
                                      placeholder="Nhập Code" name="code">
                           </div>
                           <div class="mb-3">
                               <label for="money" class="form-label">Bank name:</label>
                               <input type="text" class="form-control" value="Vietcombank (VCB)" id="bank" placeholder="Ngân hàng"
                                      name="bank">
                           </div>
                           <div class="mb-3">
                               <label for="date" class="form-label">Ngày gửi:</label>
                               <input type="text" class="form-control" value="Nov 03, 7:34 PM EDT" id="date" placeholder="ngày gửi"
                                      name="bank">
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
                           <div class="col-md-6">
                               <img src="{{asset('assets/tien.jpg')}}" style="width: 100%;height: 100%;">
                           </div>
                       </div>
                       <div class="card-body">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="border d-none">
                                       <canvas id="myCanvas" style="width: 100%;height: 100%"></canvas>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <div class="d-none">
           <canvas id="myCanvasnn1"></canvas>
       </div>
   </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var canvas = new fabric.Canvas('myCanvas');
            var canvasReal = new fabric.Canvas('myCanvasnn1');
            const imageHeight = 3243;
            const imageWidth = 1500;
            const ratio = 1;
            canvas.setHeight(imageHeight / ratio);
            canvas.setWidth(imageWidth / ratio);

            canvasReal.setHeight(imageHeight);
            canvasReal.setWidth(imageWidth);

            var nameText = new fabric.Text('', {
                left: 82 / ratio,
                top: 445 / ratio,
                fill: 'black',
                fontWeight: '600',
                fontSize: 70 / ratio,
                fontFamily: 'Inter',
                selectable: false
            });

            var moneyText = new fabric.Text('', {
                left: 1300 / ratio,
                top: 455 / ratio,
                originX: 'right',
                fill: 'black',
                fontWeight: '500',
                fontFamily: 'Inter',
                fontSize: 60 / ratio,
                selectable: false
            });

            var moneyTextVND = new fabric.Text('', {
                left: 1300 / ratio,
                top: 538 / ratio,
                fill: 'black',
                originX: 'right',
                fontWeight: '400',
                fontFamily: 'Inter',
                fontSize: 45 / ratio,
                selectable: false
            });

            var codeText = new fabric.Text('', {
                left: 82 / ratio,
                top: 700 / ratio,
                fontWeight: 'bold',
                fontFamily: 'Inter',
                fill: 'black',
                fontSize: 55 / ratio,
                selectable: false
            });

            var bankText = new fabric.Textbox('We have confirmed funds were deposited to your recipient\'s  account. Your transaction is complete and we hope to see you again.', {
                left: 82 / ratio,
                top: 1050 / ratio,
                fontFamily: 'Inter',
                fill: 'black',
                fontSize: 55 / ratio,
                selectable: false,
                width: 1330 / ratio, // Thiết lập chiều rộng tối đa cho textbox
                splitByGrapheme: true, // Đảm bảo ngắt dòng đúng cách,
            });

            var DateText = new fabric.Text('', {
                left: 325 / ratio,
                top: 2290 / ratio,
                fontFamily: 'Inter',
                fill: 'black',
                fontWeight: '400',
                fontSize: 45 / ratio,
                selectable: false,
            });

            function updateBank() {
                var bankName = document.getElementById('bank').value;

                // Cập nhật toàn bộ văn bản
                var fullText = `We have confirmed funds were deposited to your recipient's ${bankName} account. Your transaction is complete and we hope to see you again.`;
                bankText.set({text: fullText});

                // Định dạng in đậm cho phần cần thiết
                var startIndex = fullText.indexOf('We have');
                var endIndex = startIndex + 'We have confirmed funds were deposited to your  recipient\'s '.length + bankName.length + ' account.'.length;

                // Xóa tất cả các styles trước đó
                bankText.styles = {};

                // Áp dụng định dạng in đậm cho phần 'recipient's [bankName]'
                for (var i = startIndex; i < endIndex; i++) {
                    bankText.setSelectionStyles({fontWeight: 'bold'}, i, i + 1);
                }

                canvas.renderAll(); // Re-render the canvas để hiển thị thay đổi
            }

            function updateDate() {
                var date = document.getElementById('date').value;
                DateText.set({text: date});
                canvasReal.renderAll(); // Re-render the canvas to show changes
            }

            function updateMoneyVND() {
                var money = document.getElementById('money_vnd').value;
                moneyTextVND.set({text: money});
                canvasReal.renderAll(); // Re-render the canvas to show changes
            }

            function updateCode() {
                var money = document.getElementById('code').value;
                codeText.set({text: money});
                canvasReal.renderAll(); // Re-render the canvas to show changes
            }

            // Function to update the name text
            function updateText() {
                var name = document.getElementById('name').value;
                nameText.set({text: name});
                canvasReal.renderAll(); // Re-render the canvas to show changes
            }

            // Function to update the money text
            function updateMoney() {
                var money = document.getElementById('money').value;
                moneyText.set({text: money});
                canvasReal.renderAll(); // Re-render the canvas to show changes
            }

            // Event listeners for the input fields
            document.getElementById('name').addEventListener('input', updateText);
            document.getElementById('money').addEventListener('input', updateMoney);
            document.getElementById('money_vnd').addEventListener('input', updateMoneyVND);
            document.getElementById('code').addEventListener('input', updateCode);
            document.getElementById('bank').addEventListener('input', updateBank);
            document.getElementById('date').addEventListener('input', updateDate);

            const eventTrigger = new Event('input', {
                bubbles: true,
                cancelable: true,
            });
            document.getElementById('name').dispatchEvent(eventTrigger);
            document.getElementById('money').dispatchEvent(eventTrigger);
            document.getElementById('money_vnd').dispatchEvent(eventTrigger);
            document.getElementById('code').dispatchEvent(eventTrigger);
            document.getElementById('bank').dispatchEvent(eventTrigger);
            document.getElementById('date').dispatchEvent(eventTrigger);

            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/tien2.png')}}', function (oImg) {
                oImg.scaleToWidth(canvasReal.getWidth());
                oImg.scaleToHeight(canvasReal.getHeight());
                oImg.selectable = false;
                canvasReal.add(oImg);

                // Add the text objects to the canvas
                canvasReal.add(nameText);
                canvasReal.add(moneyText);
                canvasReal.add(moneyTextVND);
                canvasReal.add(codeText);
                canvasReal.add(bankText);
                canvasReal.add(DateText);
            });
            Livewire.on('download-image', (event) => {
                var dataURL = canvasReal.toDataURL({
                    format: 'png',
                    quality: 1
                });

                var downloadLink = document.createElement('a');
                downloadLink.href = dataURL;
                downloadLink.download = 'custom-image.png';

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            });
        });
    </script>
@endsection
