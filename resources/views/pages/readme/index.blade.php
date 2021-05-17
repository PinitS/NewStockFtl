@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card text-white bg-secondary">
            <div class="card-header">
                <h5 class="card-title text-white">การเพิ่ม <strong class="text-danger">"อุปกรณ์"</strong> ภายในสต๊อก
                </h5>
            </div>
            <div class="card-body mb-0">
                <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> กรณีที่ยังไม่เคย สร้าง กลุ่มอุปกรณ์ <strong class="text-danger">*****</strong> <br />
                    <span>1.ไปที่ <strong class="text-danger">จัดการ -> หน่วย</strong> ทำการเพิ่มหน่วย</span> <br />
                    <span>2.ไปที่ <strong class="text-danger">จัดการ -> กลุ่มอุปกรณ์</strong> ทำการเพิ่ม ชื่อ อุปกรณ์ (เช่น R35K) ราคา และ หน่วย</span><br />
                    <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> หากต้อง <strong class="text-warning">แก้ไข</strong> ราคาต้นทุน ให้มาแก้ที่ กลุ่มอุปกรณ์ </span><strong class="text-danger">*****</strong> <br />
                    <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> กรณ๊ที่ ลบ ไม่ได้ <strong class="text-warning">ต้องทำการลบ อุปรกณ์ ภายในสต๊อก หรือ ภายใน สินค้า ให้หมด </strong> </span><strong class="text-danger">*****</strong> <br />
                    <br>

                    <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> กรณีที่ยังไม่เคย สร้าง สาขา <strong class="text-danger">*****</strong> </span><br />
                    <span>3.ไปที่ <strong class="text-danger">จัดการ -> สาขา</strong> ทำการเพิ่ม ชื่อ สาขา เช่น (เชียงใหม่)</span><br />
                    <br>

                    <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> กรณีที่ยังไม่เคย สร้าง หมวดหมู่อุปกรณ์
                        <strong class="text-danger">*****</strong> </span><br />
                    <span>4.ไปที่ <strong class="text-danger">คลัง -> หมวดหมู่</strong> ทำการเพิ่ม ชื่อหมวดหมู่ อุปกรณ์</span><br />
                    <span>5.ไปที่ <strong class="text-danger">คลัง -> อุปกรณ์</strong> ทำการเพิ่ม อุปกรณ์ จำนวน อื่นๆลงไป</span><br />
                    <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> หากต้อง <strong class="text-warning">แก้ไข</strong> จำนวน ที่ใส่ผิด ให้ไปที่ปุ่ม </span> <button class='btn btn-secondary btn-sm text-white active'><i class='fa fa-history'></i></button>
                    <strong class="text-danger">*****</strong> <br />
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card text-white bg-secondary">
            <div class="card-header">
                <h5 class="card-title text-white">การเพิ่ม <strong class="text-danger">"สินค้า"</strong>
                    ภายในสต๊อก
                </h5>
            </div>
            <div class="card-body mb-0">
                <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> กรณีที่ยังไม่เคย สร้าง สินค้า <strong class="text-danger">*****</strong> <br />
                    <span>1.ไปที่ <strong class="text-danger">จัดการ -> หมวดหมู่สินค้า</strong> ทำการเพิ่มหมวดหมู่สินค้า</span> <br />
                    <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> กรณ๊ที่ ลบ ไม่ได้ <strong class="text-warning">ต้องทำการลบ สินค้า ที่อยู่ภายในหมวดหมู่นั้นๆให้หมดก่อน </strong> </span><strong class="text-danger">*****</strong> <br />
                    <span>2.ไปที่ <strong class="text-danger">สินค้า</strong> ทำการ เลือก หมวดหมู่ ใส่ราคาขาย อื่นๆ</span><br /><br>
                    <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> ราคาต้นทุน เกิดจาก การเพิ่ม อุปกรณ์ลงไปภายในสินค้า
                        <strong class="text-danger">*****</strong></span> <br />
                        <span style="padding-left: 3.2em"><strong class="text-danger">*****</strong> <strong class="text-warning">หากต้องการเพิ่ม อุปกรณ์เข้าไปภายในสินค้า</strong>
                            <strong class="text-danger">*****</strong> <br />
                    <span>3.ไปที่ <button class='btn btn-secondary btn-sm text-white active'><i class='fa fa-file'></i></button>ทำการเพิ่ม อุปกรณ์ลงไปภายในสินค้า</strong>  </span><br />
                    <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> หากต้อง <strong class="text-warning">แก้ไข</strong> ราคาต้นทุน ให้มาแก้ที่ กลุ่มอุปกรณ์ </span><strong class="text-danger">*****</strong> <br />

            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card text-white bg-secondary">
            <div class="card-header">
                <h5 class="card-title text-white">การคำนวณ <strong class="text-danger">"การสั่งซื้อสินค้า"</strong></h5>
            </div>
            <div class="card-body mb-0">
                <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> กรณีที่ยังไม่เคย เพิ่มอุปกรณ์ ลงไปภายในสินค้า <strong class="text-danger">*****</strong> <br />
                    <span>1.ไปอ่าน <strong class="text-danger">การเพิ่ม "สินค้า" ภายในสต๊อก </strong> ช้อ 3.</span> <br />
                    <span style="padding-left: 1.8em"><strong class="text-danger">*****</strong> กรณ๊ที่ ลบ ไม่ได้ <strong class="text-warning">ต้องทำการลบ สินค้า ที่อยู่ภายในหมวดหมู่นั้นๆให้หมดก่อน </strong> </span><strong class="text-danger">*****</strong> <br />
                    <span>2.เลือก อุปกรณ์ ที่มุมบนขวามือ <strong class="text-danger">ทำการใส่จำนวน</strong> </span><br/><br>
            </div>
        </div>
    </div>


</div>

@endsection