@extends('core::layouts.master')
@section('content')
    <div class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Tên người nhận:</label>
                                <input type="text" class="form-control" value="Chuyển thành công" id="name_tech" placeholder="Nhập tên" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="money" class="form-label">Nhập số tiền:</label>
                                <input type="text" class="form-control" value="1,000.00" id="money_tech" placeholder="Nhập số tiền" name="money">
                            </div>
                            <div class="mb-3">
                                <label for="money" class="form-label">Bank name:</label>
                                <input type="text" class="form-control" value="" id="bank_tech" placeholder="Ngân hàng" name="bank">
                            </div>
                            <div class="mb-3">
                                <label for="money" class="form-label">Số tài khoản:</label>
                                <input type="text" class="form-control" value="" id="bank_tech_number" placeholder="Số tài khoản" name="number">
                            </div>
                            <div class="mb-3">
                                <label for="money" class="form-label">Nội dung chuyển khoản:</label>
                                <input type="text" class="form-control" value="" id="des" placeholder="Nội dung chuyển khoản" name="des">
                            </div>
                            <div class="mb-3">
                                <label for="money" class="form-label">Ngày tháng chuyển khoản:</label>
                                <input type="text" class="form-control" value="" id="date_tech" placeholder="Ngày tháng chuyển khoản" name="des">
                            </div>
                            <div class="mb-3">
                                <label for="money" class="form-label">Nhập số tiền Mã Code:</label>
                                <input type="text" class="form-control" value="R123123213121" id="code_tech" placeholder="Nhập Code" name="code">
                            </div>


                            <div class="mb-3">
                                <livewire:bank::download-image />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card" style="max-height: 600px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 d-none">
                                    <canvas id="myCanvas2"  ></canvas>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{asset('assets/banks/tech2.png')}}" style="width: 100%" alt="">
                                </div>
                                <canvas id="myCanvas3" style="display: none"  ></canvas>
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
            var canvas = new fabric.Canvas('myCanvas2');
            canvas.setHeight(500);
            canvas.setWidth(500);
            //
            var Title = new fabric.Text('Chuyển thành công', {
                left: 17,
                top: 196,
                fill: '#080707',
                fontWeight: 'bold',
                fontSize: 21,
                fontFamily: 'Arial',
                selectable: false,
            });
            // Prepare the text objects without initial text
            var nameText = new fabric.Text('', {
                left: 17,
                top: 225,
                fill: '#080707',
                fontWeight: 'bold',
                fontSize: 21,
                fontFamily: 'Nunito Sans, sans-serif',
                selectable: false
            });

            var moneyText = new fabric.Text('', {
                left: 17,
                top: 254,
                fill: '#080707',
                fontWeight: 'bold',
                fontSize: 22,
                fontFamily: 'Nunito Sans, sans-serif',
                selectable: false
            });



            var codeText = new fabric.Text('', {
                left: 18,
                top: 470,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            var BankText = new fabric.Text('', {
                left: 18,
                top: 317,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            var BankNumber = new fabric.Text('', {
                left: 18,
                top: 331,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            var Des = new fabric.Text('', {
                left: 18,
                top: 375,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            var date = new fabric.Text('', {
                left: 18,
                top: 420,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            function setDate() {
                var bank = document.getElementById('date_tech').value;
                console.log(bank);
                date.set({ text: bank });
                canvas.renderAll(); // Re-render the canvas to show changes
            }

            function setBank() {
                var bank = document.getElementById('bank_tech').value;
                BankText.set({ text: bank });
                canvas.renderAll(); // Re-render the canvas to show changes
            }

            function setBankNumber() {
                var bank = document.getElementById('bank_tech_number').value;
                BankNumber.set({ text: bank });
                canvas.renderAll(); // Re-render the canvas to show changes
            }

            function setDes() {
                var bank = document.getElementById('des').value;
                Des.set({ text: bank });
                canvas.renderAll(); // Re-render the canvas to show changes
            }
            function setTitile() {
                Title.set({ text: `Chuyển thành công` });
                canvas.renderAll(); // Re-render the canvas to show changes
            }
            setTitile();

            function updateCode() {
                var money = document.getElementById('code_tech').value;
                codeText.set({ text: money });
                canvas.renderAll(); // Re-render the canvas to show changes
            }

            // Function to update the name text
            function updateText() {
                var name = document.getElementById('name_tech').value;
                nameText.set({ text: `Tới ${name}` });
                canvas.renderAll(); // Re-render the canvas to show changes
            }

            // Function to update the money text
            function updateMoney() {
                var money = document.getElementById('money_tech').value;
                moneyText.set({ text: `VND ${money}` });
                canvas.renderAll(); // Re-render the canvas to show changes
            }

            // Event listeners for the input fields
            document.getElementById('name_tech').addEventListener('input', updateText);
            document.getElementById('money_tech').addEventListener('input', updateMoney);
            document.getElementById('code_tech').addEventListener('input', updateCode);
            document.getElementById('bank_tech').addEventListener('input', setBank);
            document.getElementById('bank_tech_number').addEventListener('input', setBankNumber);
            document.getElementById('des').addEventListener('input', setDes);
            document.getElementById('date_tech').addEventListener('input', setDate);
            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/teck.png')}}', function (oImg) {
                oImg.scaleToWidth(canvas.getWidth());
                oImg.scaleToHeight(canvas.getHeight());
                oImg.selectable = false;
                canvas.add(oImg);

                // Add the text objects to the canvas
                canvas.add(nameText);
                canvas.add(moneyText);
                canvas.add(codeText);
                canvas.add(Title);
                canvas.add(BankText);
                canvas.add(BankNumber);
                canvas.add(Des);
                canvas.add(date);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var canvas2 = new fabric.Canvas('myCanvas3');
            canvas2.setHeight(2560);
            canvas2.setWidth(1422);
            // canvas.setZoom(0.7);
            //
            var Title2 = new fabric.Text('Chuyển thành công', {
                left: 98,
                top: 1003.52,
                fill: '#080707',
                fontWeight: 'bold',
                fontSize: 100,
                fontFamily: 'Arial',
                selectable: false,
            });
            // Prepare the text objects without initial text
            var nameText2 = new fabric.Text('', {
                left: 98,
                top: 1152,
                fill: '#080707',
                fontWeight: 'bold',
                fontSize: 100,
                fontFamily: 'Nunito Sans, sans-serif',
                selectable: false
            });

            var moneyText2= new fabric.Text('', {
                left: 98,
                top: 1300.48,
                fill: '#080707',
                fontWeight: 'bold',
                fontSize: 102,
                fontFamily: 'Nunito Sans, sans-serif',
                selectable: false
            });



            var codeText2 = new fabric.Text('', {
                left: 100,
                top: 2406.4,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 60,
                selectable: false
            });

            var BankText2 = new fabric.Text('', {
                left: 100,
                top: 1623.04,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 60,
                selectable: false
            });

            var BankNumber2 = new fabric.Text('', {
                left: 100,
                top: 1694.72,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 60,
                selectable: false
            });

            var Des2 = new fabric.Text('', {
                left: 100,
                top: 1920,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 60,
                selectable: false
            });

            var date2 = new fabric.Text('', {
                left: 100,
                top: 2150.4,
                fontWeight: 'bold',
                fontFamily: 'Nunito Sans, sans-serif',
                fill: 'black',
                fontSize: 60,
                selectable: false
            });

            function setDate2() {
                var bank = document.getElementById('date_tech').value;
                date2.set({ text: bank });
                canvas2.renderAll(); // Re-render the canvas to show changes
            }

            function setBank2() {
                var bank = document.getElementById('bank_tech').value;
                BankText2.set({ text: bank });
                canvas2.renderAll(); // Re-render the canvas to show changes
            }

            function setBankNumber2() {
                var bank = document.getElementById('bank_tech_number').value;
                BankNumber2.set({ text: bank });
                canvas2.renderAll(); // Re-render the canvas to show changes
            }

            function setDes2() {
                var bank = document.getElementById('des').value;
                Des2.set({ text: bank });
                canvas2.renderAll(); // Re-render the canvas to show changes
            }
            function setTitile2() {
                Title2.set({ text: `Chuyển thành công` });
                canvas2.renderAll(); // Re-render the canvas to show changes
            }
            setTitile2();

            function updateCode2() {
                var money = document.getElementById('code_tech').value;
                codeText2.set({ text: money });
                canvas2.renderAll(); // Re-render the canvas to show changes
            }

            // Function to update the name text
            function updateText2() {
                var name = document.getElementById('name_tech').value;
                nameText2.set({ text: `Tới ${name}` });
                canvas2.renderAll(); // Re-render the canvas to show changes
            }

            // Function to update the money text
            function updateMoney2() {
                var money = document.getElementById('money_tech').value;
                moneyText2.set({ text: `VND ${money}` });
                canvas2.renderAll(); // Re-render the canvas to show changes
            }

            // Event listeners for the input fields
            document.getElementById('name_tech').addEventListener('input', updateText2);
            document.getElementById('money_tech').addEventListener('input', updateMoney2);
            document.getElementById('code_tech').addEventListener('input', updateCode2);
            document.getElementById('bank_tech').addEventListener('input', setBank2);
            document.getElementById('bank_tech_number').addEventListener('input', setBankNumber2);
            document.getElementById('des').addEventListener('input', setDes2);
            document.getElementById('date_tech').addEventListener('input', setDate2);
            // Load the image and add it to the canvas
            fabric.Image.fromURL('{{asset('assets/banks/teck.png')}}', function (oImg) {
                oImg.scaleToWidth(canvas2.getWidth());
                oImg.scaleToHeight(canvas2.getHeight());
                oImg.selectable = false;
                canvas2.add(oImg);

                // Add the text objects to the canvas
                canvas2.add(nameText2);
                canvas2.add(moneyText2);
                canvas2.add(codeText2);
                canvas2.add(Title2);
                canvas2.add(BankText2);
                canvas2.add(BankNumber2);
                canvas2.add(Des2);
                canvas2.add(date2);
            });
            Livewire.on('download-image', (event) => {
                var dataURL = canvas2.toDataURL({
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
