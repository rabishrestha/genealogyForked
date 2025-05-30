<?php

declare(strict_types=1);

return [
    // Labels
    'biological'      => 'Sinh học',
    'contact'         => 'Liên hệ',
    'person'          => 'Người',
    'person_metadata' => 'Siêu dữ liệu về người',
    'people'          => 'Người',

    'family'  => 'Gia đình',
    'profile' => 'Hồ sơ',

    'partner'  => 'Đối tác',
    'partners' => 'Đối tác',

    'children'      => 'Con cái',
    'parents'       => 'Cha mẹ',
    'grandchildren' => 'Cháu nội',
    'siblings'      => 'Anh chị em',
    'ancestors'     => 'Tổ tiên',
    'descendants'   => 'Hậu duệ',
    'birth'         => 'Sinh',
    'dead'          => 'Chết',
    'death'         => 'Cái chết',
    'deceased'      => 'Người đã mất',

    'grandmother'   => 'Bà ngoại',
    'grandfather'   => 'Ông ngoại',
    'nieces'        => 'Cháu gái',
    'nephews'       => 'Cháu trai',
    'cousins'       => 'Anh chị em họ',
    'uncles'        => 'Chú',
    'aunts'         => 'Cô',
    'relationships' => 'Mối quan hệ',
    'age'           => 'Tuổi',
    'years'         => '[0,1] Năm|[2,*] Năm',

    'source'           => 'Nguồn',
    'source_hint'      => 'Xác định nguồn của tệp mà bạn sẽ tải lên',
    'source_date'      => 'Ngày',
    'source_date_hint' => 'Xác định ngày của nguồn tệp mà bạn sẽ tải lên',

    // Actions
    'add_father'                     => 'Thêm cha',
    'add_new_person_as_father'       => 'Thêm NGƯỜI MỚI làm cha',
    'add_existing_person_as_father'  => 'Thêm NGƯỜI ĐÃ TỒN TẠI làm cha',
    'add_mother'                     => 'Thêm mẹ',
    'add_new_person_as_mother'       => 'Thêm NGƯỜI MỚI làm mẹ',
    'add_existing_person_as_mother'  => 'Thêm NGƯỜI ĐÃ TỒN TẠI làm mẹ',
    'add_child'                      => 'Thêm con',
    'add_new_person_as_child'        => 'Thêm NGƯỜI MỚI làm con',
    'add_existing_person_as_child'   => 'Thêm NGƯỜI ĐÃ TỒN TẠI làm con',
    'add_person'                     => 'Thêm người',
    'add_new_person_as_partner'      => 'Thêm NGƯỜI MỚI làm đối tác',
    'add_existing_person_as_partner' => 'Thêm NGƯỜI ĐÃ TỒN TẠI làm đối tác',
    'add_person_in_team'             => 'Thêm người vào nhóm : :team',
    'add_photo'                      => 'Thêm ảnh',
    'add_relationship'               => 'Thêm mối quan hệ',

    'edit'              => 'Chỉnh sửa',
    'edit_children'     => 'Chỉnh sửa con cái',
    'edit_contact'      => 'Chỉnh sửa liên hệ',
    'edit_death'        => 'Chỉnh sửa cái chết',
    'edit_family'       => 'Chỉnh sửa gia đình',
    'edit_files'        => 'Chỉnh sửa tệp',
    'edit_person'       => 'Chỉnh sửa người',
    'edit_profile'      => 'Chỉnh sửa hồ sơ',
    'edit_relationship' => 'Chỉnh sửa mối quan hệ',

    'delete_child'        => 'Ngắt kết nối con',
    'delete_person'       => 'Xóa người',
    'delete_relationship' => 'Xóa mối quan hệ',

    // Attributes
    'id'          => 'ID',
    'name'        => 'Tên',
    'names'       => 'Tên',
    'firstname'   => 'Tên đầu tiên',
    'surname'     => 'Họ',
    'birthname'   => 'Tên khai sinh',
    'nickname'    => 'Biệt danh',
    'sex'         => 'Giới tính',
    'gender'      => 'Giới tính xác định',
    'father'      => 'Cha',
    'mother'      => 'Mẹ',
    'parent'      => 'Cha mẹ',
    'dob'         => 'Ngày sinh',
    'yob'         => 'Năm sinh',
    'pob'         => 'Nơi sinh',
    'dod'         => 'Ngày mất',
    'yod'         => 'Năm mất',
    'pod'         => 'Nơi mất',
    'summary'     => 'Tóm tắt',
    'email'       => 'Email',
    'password'    => 'Mật khẩu',
    'address'     => 'Địa chỉ',
    'street'      => 'Đường',
    'number'      => 'Số',
    'postal_code' => 'Mã bưu chính',
    'city'        => 'Thành phố',
    'province'    => 'Tỉnh',
    'state'       => 'Bang',
    'country'     => 'Quốc gia',
    'phone'       => 'Điện thoại',

    'cemetery'          => 'Nghĩa trang',
    'cemetery_location' => 'Vị trí nghĩa trang',

    // files
    'files'            => 'Tệp',
    'files_saved'      => '[0] Không có tệp nào được lưu|[1] Tệp được lưu|[2,*] Tệp được lưu',
    'file'             => 'Tệp',
    'file_deleted'     => 'Tệp đã bị xóa',
    'upload_files'     => 'Tải lên tệp',
    'upload_files_tip' => 'Kéo và thả các tệp mới của bạn vào đây ...',

    'upload_accept_types' => 'Cho phép : :types',
    'upload_max_size'     => 'Kích thước tối đa : :max KB',

    // Photo
    'avatar'            => 'Ảnh đại diện',
    'edit_photos'       => 'Chỉnh sửa ảnh',
    'photo_deleted'     => 'Ảnh đã bị xóa',
    'photo'             => 'Ảnh',
    'photos'            => 'Ảnh',
    'photos_saved'      => '[0] Không có ảnh nào được lưu|[1] Ảnh được lưu|[2,*] Ảnh được lưu',
    'photos_existing'   => 'Ảnh hiện có',
    'set_primary'       => 'Đặt làm chính',
    'upload_photos'     => 'Tải lên ảnh',
    'upload_photos_tip' => 'Kéo và thả các ảnh mới của bạn vào đây ...',

    // Messages
    'yod_not_matching_dod' => 'Năm mất phải khớp với ngày mất (:value).',
    'yod_before_dob'       => 'Năm mất không thể trước ngày sinh (:value).',
    'yod_before_yob'       => 'Năm mất không thể trước năm sinh (:value).',

    'dod_not_matching_yod' => 'Ngày mất phải khớp với năm mất (:value).',
    'dod_before_dob'       => 'Ngày mất không thể trước ngày sinh (:value).',
    'dod_before_yob'       => 'Ngày mất không thể trước năm sinh (:value).',

    'yob_not_matching_dob' => 'Năm sinh phải khớp với ngày sinh (:value).',
    'yob_after_dod'        => 'Năm sinh không thể sau ngày mất (:value).',
    'yob_after_yod'        => 'Năm sinh không thể sau năm mất (:value).',

    'dob_not_matching_yob' => 'Ngày sinh phải khớp với năm sinh (:value).',
    'dob_after_dod'        => 'Ngày sinh không thể sau ngày mất (:value).',
    'dob_after_yod'        => 'Ngày sinh không thể sau năm mất (:value).',

    'not_found' => 'Không tìm thấy người',
    'use_tab'   => 'Sử dụng tab',
];
