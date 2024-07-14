import { usePage, useForm } from "@inertiajs/react";
import React, { useEffect, useState } from "react";
import { toast } from "react-toastify";
import Layout from "../Components/Layout";
import { format } from "date-fns";
import "flatpickr/dist/themes/material_green.css";
import Flatpickr from "react-flatpickr";
import { FaArrowCircleUp } from "react-icons/fa";
import Select from "react-select";
import Modal from "react-modal";
import { BiPlusCircle } from "react-icons/bi";
import Lightbox from "../Components/Lightbox";
function Member() {
    const { props } = usePage();
    const { message } = props.flash;
    const { user, countries } = props;

    const [isEditing, setIsEditing] = useState(false);
    const [lightboxOpen, setLightboxOpen] = useState(false);
    const [photoIndex, setPhotoIndex] = useState(0);
    const [profileImage, setProfileImage] = useState(user.profile_image);
    const [coverImage, setCoverImage] = useState(user.cover_image);
    const [gallery, setGallery] = useState(user.gallery || []);
    const [isGalleryModalOpen, setIsGalleryModalOpen] = useState(false);

    const { data, setData, post, reset } = useForm({
        full_name: user.full_name,
        preferred_name: user.preferred_name,
        mobile_number: user.mobile_number,
        date_of_birth: user.date_of_birth,
        date_of_joining: user.date_of_joining,
        function: user.function,
        date_of_leaving: user.date_of_leaving,
        anniversary: user.anniversary,
        other_functions: user.other_functions,
        country: user.country_id,
        facebook_profile: user.facebook_profile,
        whatsapp_number: user.whatsapp_number,
        fun_fact_about_you: user.fun_fact_about_you,
        spouse_dob: user.spouse_dob,
        first_child_name: user.first_child_name,
        second_child_name: user.second_child_name,
        third_child_name: user.third_child_name,
        profileImage: null,
        coverImage: null,
        gallery: [],
    });

    useEffect(() => {
        if (message?.type == "success") {
            toast.success(message.content);
        }
    }, [message]);

    const handleProfileImageChange = (e) => {
        const file = e.target.files[0];
        setProfileImage(URL.createObjectURL(file));
        data.profileImage = file;
    };

    const handleCoverImageChange = (e) => {
        const file = e.target.files[0];
        setCoverImage(URL.createObjectURL(file));
        data.coverImage = file;
    };

    const handleImageClick = () => {
        setIsGalleryModalOpen(true);
    };

    const handleModalImageClick = (index) => {
        setPhotoIndex(index);
        setLightboxOpen(true);
    };

    const closeModal = () => {
        setIsGalleryModalOpen(false);
    };

    const addNewImage = (e) => {
        const file = e.target.files[0];
        setGallery([...gallery, URL.createObjectURL(file)]);
        data.gallery.push(file);
    };

    if (user.account_verified_at === null) {
        return (
            <Layout>
                <div style={{ minHeight: "80vh" }}>
                    <div className="pt-5"></div>
                    <div
                        className="card"
                        style={{ width: "70%", margin: "0px auto" }}
                    >
                        <div className="card-body">
                            <h2
                                className="text-center py-3"
                                style={{ fontSize: 32 }}
                            >
                                Your account is not approved yet by admin
                            </h2>
                            <p className="text-center py-3">
                                You will access your profile whenever the admin
                                approved your account. Please be <br /> patient.
                                If you have any query please{" "}
                                <Link href="/contact">
                                    <u>Contact</u>
                                </Link>
                                .
                            </p>
                        </div>
                    </div>
                </div>
            </Layout>
        );
    }

    return (
        <Layout>
            <div>
                <div className="site-container">
                    <div className="py-5">
                        <div className="card p-2">
                            <div className="card-body">
                                <div className="position-relative mt-3">
                                    <img
                                        src={
                                            coverImage ||
                                            "https://picsum.photos/200/300"
                                        }
                                        alt="Cover"
                                        className="coverImage"
                                    />
                                    {isEditing && (
                                        <div
                                            className="text-white position-absolute"
                                            style={{
                                                bottom: "10px",
                                                right: "10px",
                                                cursor: "pointer",
                                            }}
                                        >
                                            <label
                                                htmlFor="coverImageUpload"
                                                style={{ cursor: "pointer" }}
                                            >
                                                <u>Upload cover photo</u>
                                                <FaArrowCircleUp
                                                    style={{
                                                        fontSize: "30px",
                                                        marginLeft: "8px",
                                                    }}
                                                />
                                                <input
                                                    type="file"
                                                    id="coverImageUpload"
                                                    style={{ display: "none" }}
                                                    onChange={
                                                        handleCoverImageChange
                                                    }
                                                />
                                            </label>
                                        </div>
                                    )}
                                    {!isEditing && (
                                        <div className="member-since">
                                            <p>
                                                Member Since{" "}
                                                {format(
                                                    new Date(user.created_at),
                                                    "MMMM yyyy"
                                                )}
                                            </p>
                                        </div>
                                    )}
                                    <div className="profileImage">
                                        <img
                                            src={
                                                profileImage ||
                                                "https://picsum.photos/200/300"
                                            }
                                            alt="Profile"
                                            style={{
                                                cursor: isEditing
                                                    ? "pointer"
                                                    : "default",
                                            }}
                                            onClick={
                                                isEditing
                                                    ? () =>
                                                          document
                                                              .getElementById(
                                                                  "profileImageUpload"
                                                              )
                                                              .click()
                                                    : null
                                            }
                                        />
                                        {isEditing && (
                                            <>
                                                <input
                                                    type="file"
                                                    id="profileImageUpload"
                                                    style={{ display: "none" }}
                                                    onChange={
                                                        handleProfileImageChange
                                                    }
                                                />
                                            </>
                                        )}
                                        <div className="mb-4 ms-3 text-white profile-info">
                                            <h4 style={{ fontSize: "20px" }}>
                                                {user.full_name}
                                            </h4>
                                            <p style={{ fontSize: "16px" }}>
                                                Member ID: {user.id}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                {!isEditing && (
                                    <div className="member-since-mobile mt-5 text-center">
                                        <h4>{user.full_name} </h4>
                                        <p
                                            style={{
                                                color: "gray",
                                                fontSize: "12px",
                                            }}
                                        >
                                            Member ID: {user.id} | Member Since{" "}
                                            {format(
                                                new Date(user.created_at),
                                                "MMMM yyyy"
                                            )}
                                        </p>
                                    </div>
                                )}
                                <div className="row mt-4 mt-lg-5">
                                    <div className="col-xl-6">
                                        <div className="row">
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Full name
                                                    </label>
                                                    {isEditing ? (
                                                        <input
                                                            type="text"
                                                            className="form-control"
                                                            value={
                                                                data.full_name
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "full_name",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {user.full_name}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Preferred name
                                                    </label>
                                                    {isEditing ? (
                                                        <input
                                                            type="text"
                                                            className="form-control"
                                                            value={
                                                                data.preferred_name
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "preferred_name",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {
                                                                user.preferred_name
                                                            }
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Phone number
                                                    </label>
                                                    {isEditing ? (
                                                        <input
                                                            type="text"
                                                            className="form-control"
                                                            value={
                                                                data.mobile_number
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "mobile_number",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {user.mobile_number}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Date of Birth
                                                    </label>
                                                    {isEditing ? (
                                                        <Flatpickr
                                                            type="date"
                                                            className="form-control"
                                                            value={
                                                                data.date_of_birth
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "date_of_birth",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {format(
                                                                new Date(
                                                                    user.date_of_birth
                                                                ),
                                                                "d MMMM yyyy"
                                                            )}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        When did you join BAT?
                                                    </label>
                                                    {isEditing ? (
                                                        <Flatpickr
                                                            type="date"
                                                            className="form-control"
                                                            value={
                                                                data.date_of_joining
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "date_of_joining",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {format(
                                                                new Date(
                                                                    user.date_of_joining
                                                                ),
                                                                "d MMMM yyyy"
                                                            )}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Which Function?
                                                    </label>
                                                    {isEditing ? (
                                                        <input
                                                            type="text"
                                                            className="form-control"
                                                            value={
                                                                data.function
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "function",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {user.function}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        When did you leave?
                                                    </label>
                                                    {isEditing ? (
                                                        <Flatpickr
                                                            type="date"
                                                            className="form-control"
                                                            value={
                                                                data.date_of_leaving
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "date_of_leaving",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {format(
                                                                new Date(
                                                                    user.date_of_leaving
                                                                ),
                                                                "d MMMM yyyy"
                                                            )}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Your anniversary
                                                    </label>
                                                    {isEditing ? (
                                                        <Flatpickr
                                                            type="date"
                                                            format="d M Y"
                                                            className="form-control"
                                                            value={
                                                                data.anniversary
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "anniversary",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {user.anniversary ??
                                                                "N/A"}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-12">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Did you work in any
                                                        other functions?
                                                    </label>
                                                    {isEditing ? (
                                                        <input
                                                            type="text"
                                                            className="form-control"
                                                            value={
                                                                data.other_functions
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "other_functions",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {user.other_functions ??
                                                                "N/A"}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Current living country
                                                    </label>
                                                    {isEditing ? (
                                                        <Select
                                                            className=""
                                                            value={{
                                                                value: data.country,
                                                                label: countries.find(
                                                                    (country) =>
                                                                        country.id ===
                                                                        data.country
                                                                )?.name,
                                                            }}
                                                            isOptionSelected={
                                                                user.country_id
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "country",
                                                                    e.value
                                                                )
                                                            }
                                                            options={countries.map(
                                                                (country) => ({
                                                                    value: country.id,
                                                                    label: country.name,
                                                                })
                                                            )}
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {countries.find(
                                                                (country) =>
                                                                    country.id ===
                                                                    user.country_id
                                                            )?.name ?? "N/A"}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                            <div className="col-md-6">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Facebook profile
                                                    </label>
                                                    {isEditing ? (
                                                        <input
                                                            type="text"
                                                            className="form-control"
                                                            value={
                                                                data.facebook_profile
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "facebook_profile",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {user.facebook_profile ??
                                                                "N/A"}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-12">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        Your mobile number{" "}
                                                        <br />
                                                        (preferably, the one you
                                                        use for WhatsApp)
                                                    </label>
                                                    {isEditing ? (
                                                        <input
                                                            type="text"
                                                            className="form-control"
                                                            value={
                                                                data.whatsapp_number
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "whatsapp_number",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {user.whatsapp_number ??
                                                                "N/A"}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-12">
                                                <div className="mb-3">
                                                    <label className="form-label">
                                                        LinkedIn Profile
                                                    </label>
                                                    {isEditing ? (
                                                        <textarea
                                                            className="form-control"
                                                            rows={7}
                                                            value={
                                                                data.linkedin_profile
                                                            }
                                                            onChange={(e) =>
                                                                setData(
                                                                    "fun_fact_about_you",
                                                                    e.target
                                                                        .value
                                                                )
                                                            }
                                                        />
                                                    ) : (
                                                        <div
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            {user.linkedin_profile ??
                                                                "N/A"}
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-xl-6">
                                        <div
                                            className="p-3"
                                            style={{
                                                border: "1px solid #11111126",
                                                borderRadius: "10px",
                                            }}
                                        >
                                            <p className="form-label">
                                                Fun fact about you
                                            </p>
                                            {isEditing ? (
                                                <textarea
                                                    className="form-control"
                                                    rows={7}
                                                    value={
                                                        data.fun_fact_about_you
                                                    }
                                                    onChange={(e) =>
                                                        setData(
                                                            "fun_fact_about_you",
                                                            e.target.value
                                                        )
                                                    }
                                                />
                                            ) : (
                                                <p
                                                    style={{
                                                        color: "#11111199",
                                                    }}
                                                >
                                                    {user.fun_fact_about_you ??
                                                        "N/A"}
                                                </p>
                                            )}
                                        </div>
                                        <div
                                            className="mt-2 p-3"
                                            style={{
                                                border: "1px solid #11111126",
                                                borderRadius: "10px",
                                            }}
                                        >
                                            <p className="form-label">
                                                Photo gallery
                                            </p>
                                            <div className="d-flex justify-content-between align-items-center mt-2">
                                                <div
                                                    className="d-flex justify-content-between align-items-center mt-2"
                                                    onClick={handleImageClick}
                                                >
                                                    {gallery
                                                        ?.slice(0, 4)
                                                        .map((image, index) => (
                                                            <img
                                                                key={index}
                                                                src={image}
                                                                alt=""
                                                                style={{
                                                                    height: "73px",
                                                                    width: "73px",
                                                                    objectFit:
                                                                        "cover",
                                                                    borderRadius:
                                                                        "10px",
                                                                    cursor: "pointer",
                                                                    margin: "10px",
                                                                }}
                                                            />
                                                        ))}
                                                </div>
                                                <div
                                                    className="w-100"
                                                    style={{
                                                        fontSize: 12,
                                                        fontWeight: 600,
                                                    }}
                                                >
                                                    {gallery?.length > 4 ? (
                                                        <span
                                                            className="ms-3 "
                                                            onClick={
                                                                handleImageClick
                                                            }
                                                            style={{
                                                                cursor: "pointer",
                                                            }}
                                                        >
                                                            +{" "}
                                                            {gallery?.length -
                                                                4}{" "}
                                                            more
                                                        </span>
                                                    ) : isEditing ? (
                                                        <div
                                                            className="ms-3 "
                                                            onClick={
                                                                handleImageClick
                                                            }
                                                        >
                                                            <BiPlusCircle
                                                                style={{
                                                                    fontSize: 40,
                                                                }}
                                                            />
                                                        </div>
                                                    ) : null}

                                                    {gallery?.length === 0 && (
                                                        <p
                                                            style={{
                                                                color: "#11111199",
                                                            }}
                                                        >
                                                            No images uploaded
                                                        </p>
                                                    )}
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            className="mt-2 p-3"
                                            style={{
                                                border: "1px solid #11111126",
                                                borderRadius: "10px",
                                            }}
                                        >
                                            <p className="form-label">
                                                Other info
                                            </p>
                                            <div className="row mt-2">
                                                <div className="col-md-6">
                                                    <div className="mb-3">
                                                        <label className="form-label">
                                                            Your spouses's
                                                            birthday
                                                        </label>
                                                        {isEditing ? (
                                                            <Flatpickr
                                                                type="date"
                                                                className="form-control"
                                                                value={
                                                                    data.spouse_dob
                                                                }
                                                                onChange={(e) =>
                                                                    setData(
                                                                        "spouse_dob",
                                                                        e.target
                                                                            .value
                                                                    )
                                                                }
                                                            />
                                                        ) : (
                                                            <div
                                                                style={{
                                                                    color: "#11111199",
                                                                }}
                                                            >
                                                                {user.spouse_dob
                                                                    ? format(
                                                                          new Date(
                                                                              user.spouse_dob
                                                                          ),
                                                                          "d MMMM yyyy"
                                                                      )
                                                                    : "N/A"}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="row mb-3">
                                                <div className="col-md-6">
                                                    <div className="mb-3">
                                                        <label className="form-label">
                                                            First child's name
                                                        </label>
                                                        {isEditing ? (
                                                            <input
                                                                type="text"
                                                                className="form-control"
                                                                value={
                                                                    data.first_child_name
                                                                }
                                                                onChange={(e) =>
                                                                    setData(
                                                                        "first_child_name",
                                                                        e.target
                                                                            .value
                                                                    )
                                                                }
                                                            />
                                                        ) : (
                                                            <div
                                                                style={{
                                                                    color: "#11111199",
                                                                }}
                                                            >
                                                                {user.first_child_name ??
                                                                    "N/A"}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                                <div className="col-md-6">
                                                    <div className="mb-3">
                                                        <label className="form-label">
                                                            First child's
                                                            birthday
                                                        </label>
                                                        {isEditing ? (
                                                            <Flatpickr
                                                                type="date"
                                                                className="form-control"
                                                                value={
                                                                    data.first_child_dob
                                                                }
                                                                onChange={(e) =>
                                                                    setData(
                                                                        "first_child_dob",
                                                                        e.target
                                                                            .value
                                                                    )
                                                                }
                                                            />
                                                        ) : (
                                                            <div
                                                                style={{
                                                                    color: "#11111199",
                                                                }}
                                                            >
                                                                {user.first_child_dob ??
                                                                    "N/A"}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="row mt-2">
                                                <div className="col-md-6">
                                                    <div className="mb-3">
                                                        <label className="form-label">
                                                            Second child's name
                                                        </label>
                                                        {isEditing ? (
                                                            <input
                                                                type="text"
                                                                className="form-control"
                                                                value={
                                                                    data.second_child_name
                                                                }
                                                                onChange={(e) =>
                                                                    setData(
                                                                        "second_child_name",
                                                                        e.target
                                                                            .value
                                                                    )
                                                                }
                                                            />
                                                        ) : (
                                                            <div
                                                                style={{
                                                                    color: "#11111199",
                                                                }}
                                                            >
                                                                {user.second_child_name ??
                                                                    "N/A"}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                                <div className="col-md-6">
                                                    <div className="mb-3">
                                                        <label className="form-label">
                                                            Second child's
                                                            birthday
                                                        </label>
                                                        {isEditing ? (
                                                            <Flatpickr
                                                                type="date"
                                                                className="form-control"
                                                                value={
                                                                    data.second_child_dob
                                                                }
                                                                onChange={(e) =>
                                                                    setData(
                                                                        "second_child_dob",
                                                                        e.target
                                                                            .value
                                                                    )
                                                                }
                                                            />
                                                        ) : (
                                                            <div
                                                                style={{
                                                                    color: "#11111199",
                                                                }}
                                                            >
                                                                {user.second_child_dob ??
                                                                    "N/A"}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="row mt-2">
                                                <div className="col-md-6">
                                                    <div className="mb-3">
                                                        <label className="form-label">
                                                            Third child's name
                                                        </label>
                                                        {isEditing ? (
                                                            <input
                                                                type="text"
                                                                className="form-control"
                                                                value={
                                                                    data.third_child_name
                                                                }
                                                                onChange={(e) =>
                                                                    setData(
                                                                        "third_child_name",
                                                                        e.target
                                                                            .value
                                                                    )
                                                                }
                                                            />
                                                        ) : (
                                                            <div
                                                                style={{
                                                                    color: "#11111199",
                                                                }}
                                                            >
                                                                {user.third_child_name ??
                                                                    "N/A"}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                                <div className="col-md-6">
                                                    <div className="mb-3">
                                                        <label className="form-label">
                                                            Third child's
                                                            birthday
                                                        </label>
                                                        {isEditing ? (
                                                            <Flatpickr
                                                                type="date"
                                                                className="form-control"
                                                                value={
                                                                    data.third_child_dob
                                                                }
                                                                onChange={(e) =>
                                                                    setData(
                                                                        "third_child_dob",
                                                                        e.target
                                                                            .value
                                                                    )
                                                                }
                                                            />
                                                        ) : (
                                                            <div
                                                                style={{
                                                                    color: "#11111199",
                                                                }}
                                                            >
                                                                {user.third_child_dob ??
                                                                    "N/A"}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="row mt-2">
                                                <div className="col-md-6">
                                                    <div className="mb-3">
                                                        <label className="form-label">
                                                            Fourth child's name
                                                        </label>
                                                        {isEditing ? (
                                                            <input
                                                                type="text"
                                                                className="form-control"
                                                                value={
                                                                    data.fourth_child_name
                                                                }
                                                                onChange={(e) =>
                                                                    setData(
                                                                        "fourth_child_name",
                                                                        e.target
                                                                            .value
                                                                    )
                                                                }
                                                            />
                                                        ) : (
                                                            <div
                                                                style={{
                                                                    color: "#11111199",
                                                                }}
                                                            >
                                                                {user.fourth_child_name ??
                                                                    "N/A"}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                                <div className="col-md-6">
                                                    <div className="mb-3">
                                                        <label className="form-label">
                                                            Fourth child's
                                                            birthday
                                                        </label>
                                                        {isEditing ? (
                                                            <Flatpickr
                                                                type="date"
                                                                className="form-control"
                                                                value={
                                                                    data.fourth_child_dob
                                                                }
                                                                onChange={(e) =>
                                                                    setData(
                                                                        "fourth_child_dob",
                                                                        e.target
                                                                            .value
                                                                    )
                                                                }
                                                            />
                                                        ) : (
                                                            <div
                                                                style={{
                                                                    color: "#11111199",
                                                                }}
                                                            >
                                                                {user.fourth_child_dob ??
                                                                    "N/A"}
                                                            </div>
                                                        )}
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
            </div>
            <Modal
                isOpen={isGalleryModalOpen}
                onRequestClose={closeModal}
                contentLabel="Gallery Modal"
                ariaHideApp={false}
            >
                <div>
                    <h2>Photo Gallery</h2>
                    <div className="d-flex flex-wrap">
                        {gallery?.map((image, index) => (
                            <img
                                key={index}
                                src={image}
                                alt=""
                                style={{
                                    height: "73px",
                                    width: "73px",
                                    objectFit: "cover",
                                    borderRadius: "10px",
                                    cursor: "pointer",
                                    margin: "10px",
                                }}
                                onClick={() => handleModalImageClick(index)}
                            />
                        ))}
                        {isEditing && (
                            <div className="card-body position-relative">
                                <BiPlus
                                    className="ms-4 mt-4"
                                    style={{
                                        fontSize: 40,
                                        cursor: "pointer",
                                        border: "1px solid #11111126",
                                        borderRadius: "10px",
                                        padding: "10px",
                                    }}
                                />
                                <input
                                    style={{
                                        opacity: 0,
                                        position: "absolute",
                                        top: 0,
                                        left: 0,
                                        right: 0,
                                        bottom: 0,
                                        width: "100%",
                                        height: "100%",
                                        cursor: "pointer",
                                    }}
                                    type="file"
                                    className="position-relative mt-4"
                                    onChange={addNewImage}
                                    multiple
                                />
                            </div>
                        )}
                    </div>
                    <div className="mt-5"></div>
                    <button
                        onClick={closeModal}
                        className="btn btn-secondary mt-5"
                    >
                        Close
                    </button>
                </div>
            </Modal>

            <Lightbox
                isOpen={lightboxOpen}
                onClose={() => setLightboxOpen(false)}
                images={gallery}
                currentIndex={photoIndex}
                setCurrentIndex={setPhotoIndex}
            />
        </Layout>
    );
}

export default Member;
