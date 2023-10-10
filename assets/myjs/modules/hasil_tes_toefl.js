// profil agency
$(document).on("click", ".editPeserta", function () {
	let form = "#editPeserta";

	let id = $(this).data("id");
	let data = { id: id };
	let result = ajax(url_base + "tes/get_peserta_toefl", "POST", data);

	$.each(result, function (key, value) {
		$(form + " [name='" + key + "']").val(value);
	});
});

// edit peserta
$(document).on("click", "#editPeserta .btnEdit", function () {
	Swal.fire({
		icon: "question",
		text: "Yakin akan mengubah data peserta?",
		showCloseButton: true,
		showCancelButton: true,
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then(function (result) {
		if (result.value) {
			let form = "#editPeserta";

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

				let result = ajax(url_base + "tes/edit_peserta_toetoeic", "POST", data);

				if (result == 1) {
					loadData();

					Swal.fire({
						position: "center",
						icon: "success",
						text: "Berhasil mengubah data peserta",
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

// peserta toeic
$(document).on("click", ".editPesertaToeic", function () {
	let form = "#editPesertaToeic";

	let id = $(this).data("id");
	let data = { id: id };
	let result = ajax(url_base + "tes/get_peserta_toeic", "POST", data);

	$.each(result, function (key, value) {
		$(form + " [name='" + key + "']").val(value);
	});
});

// edit peserta
$(document).on("click", "#editPesertaToeic .btnEdit", function () {
	Swal.fire({
		icon: "question",
		text: "Yakin akan mengubah data peserta?",
		showCloseButton: true,
		showCancelButton: true,
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then(function (result) {
		if (result.value) {
			let form = "#editPesertaToeic";

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

				let result = ajax(url_base + "tes/edit_peserta_toeic", "POST", data);

				if (result == 1) {
					loadData();

					Swal.fire({
						position: "center",
						icon: "success",
						text: "Berhasil mengubah data peserta",
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

// upload gambar
$(document).on("click", ".uploadGambar", function () {
	let id = $(this).data("id");
	let data = { id: id };
	let result = ajax(url_base + "tes/get_peserta_toefl", "POST", data);

	$("[name='id']").val(result.id);
	$("[name='nama']").val(result.nama);
});

// tambah gambar
$("#uploadGambar .btnTambah").click(function () {
	let form = "#uploadGambar";

	var fd = new FormData();
	var files = $("#file")[0].files;

	// Check file selected or not
	if (files.length > 0) {
		Swal.fire({
			icon: "question",
			text: "Yakin akan menambahkan gambar baru?",
			showCloseButton: true,
			showCancelButton: true,
			confirmButtonText: "Ya",
			cancelButtonText: "Tidak",
		}).then(function (result) {
			if (result.value) {
				fd.append("file", files[0]);
				fd.append("id", $(form + " input[name='id']").val());

				let eror = required(form);

				loading();

				if (eror == 1) {
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "lengkapi isi form terlebih dahulu",
					});
				} else {
					$.ajax({
						url: url_base + "tes/upload_data_toefl",
						type: "post",
						//   data: {fd, nama_audio:nama_audio},
						data: fd,
						contentType: false,
						processData: false,
						success: function (response) {
							if (response == 1) {
								$(form).modal("hide");
								$(".myform").trigger("reset");
								Swal.fire({
									position: "center",
									icon: "success",
									text: "Berhasil mengupload file",
									showConfirmButton: false,
									timer: 1500,
								});
							} else if (response == 2) {
								Swal.fire({
									position: "center",
									icon: "error",
									text: "Gagal mengupload file. Format file harus PNG, JPG atau JPEG",
									// showConfirmButton: false,
									// timer: 1500
								});
							} else if (response == 0) {
								Swal.fire({
									position: "center",
									icon: "error",
									text: "Gagal mengupload file",
									// showConfirmButton: false,
									// timer: 1500
								});
							}

							loadData();
						},
					});
				}
			}
		});
	} else {
		Swal.fire({
			position: "center",
			icon: "error",
			text: "Pilih file terlebih dahulu",
			showConfirmButton: false,
			timer: 1500,
		});
	}
});

$(document).on("click", ".addSertifikat", function () {
	let data = $(this).data("id");
	data = data.split("|");
	console.log(data);
	id = data[0];
	nama = data[1];

	Swal.fire({
		icon: "question",
		text: "Yakin akan menambahkan sertifikat untuk " + nama + "?",
		showCloseButton: true,
		showCancelButton: true,
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then(function (result) {
		if (result.value) {
			data = { id: id };

			let result = ajax(url_base + "tes/add_sertifikat_toefl", "POST", data);

			if (result == 1) {
				loadData();

				Swal.fire({
					position: "center",
					icon: "success",
					text: "Berhasil menambahkan sertifikat",
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

$(document).on("click", ".addSertifikatToeic", function () {
	let data = $(this).data("id");
	data = data.split("|");
	console.log(data);
	id = data[0];
	nama = data[1];

	Swal.fire({
		icon: "question",
		text: "Yakin akan menambahkan sertifikat untuk " + nama + "?",
		showCloseButton: true,
		showCancelButton: true,
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then(function (result) {
		if (result.value) {
			data = { id: id };

			let result = ajax(url_base + "tes/add_sertifikat_toeic", "POST", data);

			if (result == 1) {
				loadData();

				Swal.fire({
					position: "center",
					icon: "success",
					text: "Berhasil menambahkan sertifikat",
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
