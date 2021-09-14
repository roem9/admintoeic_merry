// ketika menekan tombol simpan pada modal tambah soal
$("#addSubSoal .btnTambah").click(function () {
	Swal.fire({
		icon: "question",
		text: "Yakin akan menambahkan sub soal baru?",
		showCloseButton: true,
		showCancelButton: true,
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then(function (result) {
		if (result.value) {
			let form = "#addSubSoal";

			let formData = {};
			$(form + " .form").each(function (index) {
				formData = Object.assign(formData, {
					[$(this).attr("name")]: $(this).val(),
				});
			});

			let eror = required(form);

			if (eror == 1) {
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "lengkapi isi form terlebih dahulu",
				});
			} else {
				data = formData;
				let result = ajax(url_base + "subsoal/add_subsoal", "POST", data);

				if (result == 1) {
					loadData();
					$("#formAddSubSoal").trigger("reset");

					Swal.fire({
						position: "center",
						icon: "success",
						text: "Berhasil menambahkan sub soal",
						showConfirmButton: false,
						timer: 1500,
					});
				} else {
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "terjadi kesalahan",
					});
				}
			}
		}
	});
});

// ketika menekan tombol edit soal
$(document).on("click", ".editSubSoal", function () {
	let form = "#editSubSoal";
	let id_sub = $(this).data("id");
	let data = { id_sub: id_sub };
	let result = ajax(url_base + "subsoal/get_subsoal", "POST", data);

    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value)
    })
});

// ketika menyimpan hasil edit soal
$("#editSubSoal .btnEdit").click(function () {
	Swal.fire({
		icon: "question",
		text: "Yakin akan mengubah data sub soal?",
		showCloseButton: true,
		showCancelButton: true,
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then(function (result) {
		if (result.value) {
			let form = "#editSubSoal";
            let formData = {};

            $(form+" .form").each(function(index){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

			let eror = required(form);

			if (eror == 1) {
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "lengkapi isi form terlebih dahulu",
				});
			} else {
				data = formData;
				let result = ajax(url_base + "subsoal/update_subsoal", "POST", data);

				if (result == 1) {
					loadData();

					Swal.fire({
						position: "center",
						icon: "success",
						text: "Berhasil mengubah data sub soal",
						showConfirmButton: false,
						timer: 1500,
					});
				} else {
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "terjadi kesalahan",
					});
				}
			}
		}
	});
});

// ketika menghapus data soal
$(document).on("click", ".hapusSubSoal", function () {
	let id_sub = $(this).data("id");

	Swal.fire({
		icon: "question",
		text: "Yakin akan menghapus sub soal ini?",
		showCloseButton: true,
		showCancelButton: true,
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then(function (result) {
		if (result.value) {
			data = { id_sub: id_sub };
			let result = ajax(url_base + "subsoal/delete_subsoal", "POST", data);

			if (result == 1) {
				loadData();

				Swal.fire({
					position: "center",
					icon: "success",
					text: "Berhasil menghapus sub soal",
					showConfirmButton: false,
					timer: 1500,
				});
			} else {
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "terjadi kesalahan",
				});
			}
		}
	});
});
