<div class="container tab-pane fade active show" id="bank3"  role="tabpanel">
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
                        <button id="download_tech" class="btn btn-primary">Download as Image</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card" style="max-height: 600px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="myCanvasvp" ></canvas>
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset('assets/vp-ex.png')}}" style="width: 100%" alt="">
                        </div>
                        <canvas id="myCanvasvp2" style="display: none"  ></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script4')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var canvas = new fabric.Canvas('myCanvasvp');
            canvas.setHeight(500);
            canvas.setWidth(500);
            //
            var Title = new fabric.Text('52 000', {
                left: 40,
                top: 95,
                fill: '#080707',
                fontWeight: 'normal',
                fontSize: 22,
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
                fontFamily: 'Arial',
                selectable: false
            });

            var moneyText = new fabric.Text('', {
                left: 17,
                top: 254,
                fill: '#080707',
                fontWeight: 'bold',
                fontSize: 22,
                fontFamily: 'Arial',
                selectable: false
            });



            var codeText = new fabric.Text('', {
                left: 18,
                top: 470,
                fontWeight: 'bold',
                fontFamily: 'Arial',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            var BankText = new fabric.Text('', {
                left: 18,
                top: 317,
                fontWeight: 'bold',
                fontFamily: 'Arial',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            var BankNumber = new fabric.Text('', {
                left: 18,
                top: 331,
                fontWeight: 'bold',
                fontFamily: 'Arial',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            var Des = new fabric.Text('', {
                left: 18,
                top: 375,
                fontWeight: 'bold',
                fontFamily: 'Arial',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            var date = new fabric.Text('', {
                left: 18,
                top: 420,
                fontWeight: 'bold',
                fontFamily: 'Arial',
                fill: 'black',
                fontSize: 12,
                selectable: false
            });

            function setDate() {
                var bank = document.getElementById('date_tech').value;
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
                Title.set({ text: `52 000` });
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
            fabric.Image.fromURL('{{asset('assets/vp-none.png')}}', function (oImg) {
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

@endsection
