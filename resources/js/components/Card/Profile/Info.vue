<template>
	<div>
		<a-card title="Thông tin cá nhân">
			<form  class="ant-form ant-form-horizontal css-dev-only-do-not-override-16xcw0g" style="max-width: 600px;">
				<div class="ant-form-item css-dev-only-do-not-override-16xcw0g">
					<div class="ant-row ant-form-row css-dev-only-do-not-override-16xcw0g">
						<div class="ant-col ant-form-item-label css-dev-only-do-not-override-16xcw0g" style="width: 100px;">
							<label class="" title="Tên">Tên</label>
						</div>
						<div class="ant-col ant-col-24 ant-form-item-control css-dev-only-do-not-override-16xcw0g">
							<div class="ant-form-item-control-input">
								<div class="ant-form-item-control-input-content">
									<input :readonly="editInfo"  type="text" 
									class="ant-input css-dev-only-do-not-override-16xcw0g"
									 v-model="user.name">
								</div>
							</div>
						</div>
					</div>
				</div>
					<div class="ant-form-item css-dev-only-do-not-override-16xcw0g">
						<div class="ant-row ant-form-row css-dev-only-do-not-override-16xcw0g">
							<div class="ant-col ant-form-item-label css-dev-only-do-not-override-16xcw0g" style="width: 100px;">
								<label class="" title="Số điện thoại">Số điện thoại</label>
							</div>
							<div class="ant-col ant-col-24 ant-form-item-control css-dev-only-do-not-override-16xcw0g">
								<div class="ant-form-item-control-input">
									<div class="ant-form-item-control-input-content">
										<input :readonly="editInfo"  type="text" class="ant-input css-dev-only-do-not-override-16xcw0g" v-model="user.phone">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ant-form-item css-dev-only-do-not-override-16xcw0g">
						<div class="ant-row ant-form-row css-dev-only-do-not-override-16xcw0g">
							<div class="ant-col ant-form-item-label css-dev-only-do-not-override-16xcw0g" style="width: 100px;">
								<label class="" title="Địa chỉ">Địa chỉ</label>
							</div>
							<div class="ant-col ant-col-24 ant-form-item-control css-dev-only-do-not-override-16xcw0g">
								<div class="ant-form-item-control-input">
									<div class="ant-form-item-control-input-content">
										<input type="text" class="ant-input css-dev-only-do-not-override-16xcw0g" v-model="user.address">
									</div>
								</div>
							</div>
						</div>
					</div>
			</form>

			<div class="flex justify-between gap-3">
				<a-button
					v-if="!editInfo"
					class="w-1/2"
					@click="() => (editInfo = true)"
					>Lưu</a-button
				>
				<a-button v-else class="w-1/2" @click="() => (editInfo = false)"
					>Cập nhật</a-button
				>
				<a-button @click="handleModal">Định danh cá nhân</a-button>
					
				<div class="modal" :class="{ 'active': showModal }">
					<div class="modal-dialog modal-dialog-centered " role="document">
        <form action="http://127.0.0.1:8000/admin/updateInfoAdmin" method="POST" id="personalIdentification" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="g4MU3qRYPAskZvClUIdEyM15LD0B0hwft9ANzUBz">            <div class="modal-content">
                <div class="form-group">
                    <input type="file" class="form-control-file" id="cccdFrontImage" name="font-image">
                    <div class="form-group">
                        <label for="cccdFrontImage">Ảnh CCCD mặt trước</label> <br>

                        <img style="width: 60px; height: 50px" src="http://127.0.0.1:8000/" alt="">
                    </div>
                </div>
                <div class="form-group">

                    <input type="file" class="form-control-file" id="cccdBackImage" name="back-image">
                    <div class="form-group">
                        <label for="cccdFrontImage">Ảnh CCCD mặt sau</label> <br>
                        <img style="width: 60px; height: 50px" src="http://127.0.0.1:8000/" alt="">
                    </div>

                </div>

                <div class="form-group">
                    <label for="cccdNumber">Số CCCD</label>
                    <input type="text" class="form-control" id="cccdNumber" name="citizen_id_number" value="" oninput="validateInput(this)">
                    <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="cccdNumber_error"></span> </div>
                </div>
                <div class="form-group">
                    <label for="bank">Chọn ngân hàng</label>
                    <select class="form-control" id="bank" name="bank">
                        <option value="">Chọn ngân hàng</option>
                                                <option value="ABB">Ngân hàng TMCP An Bình-ABBANK</option>
                                                <option value="ACB">Ngân hàng TMCP Á Châu-ACB</option>
                                                <option value="BAB">Ngân hàng TMCP Bắc Á-BacABank</option>
                                                <option value="BIDV">Ngân hàng TMCP Đầu tư và Phát triển Việt Nam-BIDV</option>
                                                <option value="BVB">Ngân hàng TMCP Bảo Việt-BaoVietBank</option>
                                                <option value="CBB">Ngân hàng Thương mại TNHH MTV Xây dựng Việt Nam-CBBank</option>
                                                <option value="CIMB">Ngân hàng TNHH MTV CIMB Việt Nam-CIMB</option>
                                                <option value="DBS">DBS Bank Ltd - Chi nhánh Thành phố Hồ Chí Minh-DBSBank</option>
                                                <option value="DOB">Ngân hàng TMCP Đông Á-DongABank</option>
                                                <option value="EIB">Ngân hàng TMCP Xuất Nhập khẩu Việt Nam-Eximbank</option>
                                                <option value="GPB">Ngân hàng Thương mại TNHH MTV Dầu Khí Toàn Cầu-GPBank</option>
                                                <option value="HDB">Ngân hàng TMCP Phát triển Thành phố Hồ Chí Minh-HDBank</option>
                                                <option value="HLBVN">Ngân hàng TNHH MTV Hong Leong Việt Nam-HongLeong</option>
                                                <option value="HSBC">Ngân hàng TNHH MTV HSBC (Việt Nam)-HSBC</option>
                                                <option value="IBK - HN">Ngân hàng Công nghiệp Hàn Quốc - Chi nhánh Hà Nội-IBKHN</option>
                                                <option value="IBK - HCM">Ngân hàng Công nghiệp Hàn Quốc - Chi nhánh TP. Hồ Chí Minh-IBKHCM</option>
                                                <option value="ICB">Ngân hàng TMCP Công thương Việt Nam-VietinBank</option>
                                                <option value="IVB">Ngân hàng TNHH Indovina-IndovinaBank</option>
                                                <option value="KLB">Ngân hàng TMCP Kiên Long-KienLongBank</option>
                                                <option value="LPB">Ngân hàng TMCP Bưu Điện Liên Việt-LienVietPostBank</option>
                                                <option value="MB">Ngân hàng TMCP Quân đội-MBBank</option>
                                                <option value="MSB">Ngân hàng TMCP Hàng Hải-MSB</option>
                                                <option value="NAB">Ngân hàng TMCP Nam Á-NamABank</option>
                                                <option value="NCB">Ngân hàng TMCP Quốc Dân-NCB</option>
                                                <option value="NHB HN">Ngân hàng Nonghyup - Chi nhánh Hà Nội-Nonghyup</option>
                                                <option value="OCB">Ngân hàng TMCP Phương Đông-OCB</option>
                                                <option value="Oceanbank">Ngân hàng Thương mại TNHH MTV Đại Dương-Oceanbank</option>
                                                <option value="PBVN">Ngân hàng TNHH MTV Public Việt Nam-PublicBank</option>
                                                <option value="PGB">Ngân hàng TMCP Xăng dầu Petrolimex-PGBank</option>
                                                <option value="PVCB">Ngân hàng TMCP Đại Chúng Việt Nam-PVcomBank</option>
                                                <option value="SCB">Ngân hàng TMCP Sài Gòn-SCB</option>
                                                <option value="SCVN">Ngân hàng TNHH MTV Standard Chartered Bank Việt Nam-StandardChartered</option>
                                                <option value="SEAB">Ngân hàng TMCP Đông Nam Á-SeABank</option>
                                                <option value="SGICB">Ngân hàng TMCP Sài Gòn Công Thương-SaigonBank</option>
                                                <option value="SHB">Ngân hàng TMCP Sài Gòn - Hà Nội-SHB</option>
                                                <option value="STB">Ngân hàng TMCP Sài Gòn Thương Tín-Sacombank</option>
                                                <option value="SHBVN">Ngân hàng TNHH MTV Shinhan Việt Nam-ShinhanBank</option>
                                                <option value="TCB">Ngân hàng TMCP Kỹ thương Việt Nam-Techcombank</option>
                                                <option value="TPB">Ngân hàng TMCP Tiên Phong-TPBank</option>
                                                <option value="UOB">Ngân hàng United Overseas - Chi nhánh TP. Hồ Chí Minh-UnitedOverseas</option>
                                                <option value="VAB">Ngân hàng TMCP Việt Á-VietABank</option>
                                                <option value="VBA">Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam-Agribank</option>
                                                <option value="VCB">Ngân hàng TMCP Ngoại Thương Việt Nam-Vietcombank</option>
                                                <option value="VCCB">Ngân hàng TMCP Bản Việt-VietCapitalBank</option>
                                                <option value="VIB">Ngân hàng TMCP Quốc tế Việt Nam-VIB</option>
                                                <option value="VIETBANK">Ngân hàng TMCP Việt Nam Thương Tín-VietBank</option>
                                                <option value="VPB">Ngân hàng TMCP Việt Nam Thịnh Vượng-VPBank</option>
                                                <option value="VRB">Ngân hàng Liên doanh Việt - Nga-VRB</option>
                                                <option value="WVN">Ngân hàng TNHH MTV Woori Việt Nam-Woori</option>
                                                <option value="KBHN">Ngân hàng Kookmin - Chi nhánh Hà Nội-KookminHN</option>
                                                <option value="KBHCM">Ngân hàng Kookmin - Chi nhánh Thành phố Hồ Chí Minh-KookminHCM</option>
                                                <option value="COOPBANK">Ngân hàng Hợp tác xã Việt Nam-COOPBANK</option>
                                                <option value="CAKE">TMCP Việt Nam Thịnh Vượng - Ngân hàng số CAKE by VPBank-CAKE</option>
                                                <option value="Ubank">TMCP Việt Nam Thịnh Vượng - Ngân hàng số Ubank by VPBank-Ubank</option>
                                                <option value="KBank">Ngân hàng Đại chúng TNHH Kasikornbank-KBank</option>
                                                <option value="VNPTMONEY">VNPT Money-VNPTMoney</option>
                                                <option value="VTLMONEY">Tổng Công ty Dịch vụ số Viettel - Chi nhánh tập đoàn công nghiệp viễn thông Quân Đội-ViettelMoney</option>
                                                <option value="TIMO">Ngân hàng số Timo by Ban Viet Bank (Timo by Ban Viet Bank)-Timo</option>
                                                <option value="CITIBANK">Ngân hàng Citibank, N.A. - Chi nhánh Hà Nội-Citibank</option>
                                                <option value="KEBHANAHCM">Ngân hàng KEB Hana – Chi nhánh Thành phố Hồ Chí Minh-KEBHanaHCM</option>
                                                <option value="KEBHANAHN">Ngân hàng KEB Hana – Chi nhánh Hà Nội-KEBHANAHN</option>
                                                <option value="MAFC">Công ty Tài chính TNHH MTV Mirae Asset (Việt Nam) -MAFC</option>
                                                <option value="VBSP">Ngân hàng Chính sách Xã hội-VBSP</option>
                        

                    </select>
                    <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="bank_error"></span> </div>
                </div>
                <div class="form-group">
                    <label for="accountNumber">Số tài khoản</label>
                    <input type="text" class="form-control" id="accountNumber" name="idnumber" value="" oninput="validateInput(this)">
                        <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="accountNumber_error"></span> </div>
                </div>
                <div class="form-group">
                    <label for="accountHolderName">Tên chủ tài khoản</label>
                    <input type="text" class="form-control" id="accountHolderName" name="bank_name" value="">
                        <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="accountHolderName_error"></span> </div>
                </div>



                <button type="button" onclick="Submutidentification(event)" class="btn btn-primary btn-sm" style="width: 100px;">Lưu</button>

            </div>
        </form>
    </div>
				</div>

				<!-- Overlay -->
				<div class="modal-overlay" :class="{ 'active': showModal }"></div>
				<!-- <a-button class="w-1/2">
					<router-link :to="{ name: 'kyc' }"> Định danh </router-link>
				</a-button> -->
			</div>
		</a-card>
		
	</div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useStore} from "vuex";
const store = useStore();
const user = ref('');
onMounted(async () => {
	const userdata = await store.getters['user'];
	user.value = userdata;
});
const editInfo = ref<boolean>(true);
	const showModal = ref(false);

// Phương thức để mở modal khi nhấp vào nút "Định danh cá nhân"
const handleModal = () => {
	showModal.value = true;
};

// Phương thức để đóng modal khi nhấp vào nút "Đóng modal"
const closeModal = () => {
	showModal.value = false;
};
</script>

<style scoped>
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999; /* Đảm bảo overlay nằm dưới modal */
}

/* Hiển thị modal khi có class 'active' */
.modal.active,
.modal-overlay.active {
    display: block;
}</style>
