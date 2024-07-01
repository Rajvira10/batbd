import { Link, useForm, usePage } from "@inertiajs/react";
import React, { useEffect } from "react";
import Select from "react-select";
import "flatpickr/dist/themes/material_green.css";
import Flatpickr from "react-flatpickr";
import { FaCalendarAlt, FaEyeSlash } from "react-icons/fa";
import { toast } from "react-toastify";

const Register = () => {
    const props = usePage().props;
    const { message } = props.flash;
    const { data, setData, post, processing, errors } = useForm({
        full_name: "",
        preferred_name: "",
        email: "",
        mobile_number: "",
        password: "",
        date_of_birth: "",
        gender: "",
        date_of_joining: "",
        function: "",
        date_of_leaving: "",
    });

    const handleChange = (e) => {
        const key = e.target.id;
        const value = e.target.value;
        setData((data) => ({
            ...data,
            [key]: value,
        }));
    };

    useEffect(() => {
        if (message?.type == "success") {
            toast.success(message.content);
        } else {
            toast.error(message?.content);
        }
    }, [message]);

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/register");
    };

    return (
        <div className="bg-main">
            <div className="container">
                <div className="row frm-pg">
                    <div className="col-xl-6 d-flex justify-content-center justify-content-xl-start text-center text-xl-start">
                        <div className="cmp-logo">
                            <img
                                className="logo-lg"
                                src="/assets/images/logo-lg.png"
                                alt=""
                                srcSet=""
                            />
                            <p className="cmp-text">
                                Reconnect and Collaborate with{" "}
                                <br className="d-none d-xl-block" /> Your
                                Ex-Colleagues at BAT BD
                            </p>
                        </div>
                    </div>
                    <div className="col-xl-6 d-flex justify-content-center justify-content-xl-end mt-5 mt-xl-0">
                        <div className="frm-wrap w-100">
                            <form onSubmit={handleSubmit}>
                                <h3 className="fm-title text-center text-xl-start">
                                    Sign Up
                                </h3>

                                <div className="row ">
                                    <div className="col-md-6 mb-2">
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="full_name"
                                            placeholder="Full Name"
                                            value={data.first_name}
                                            onChange={handleChange}
                                        />
                                        {errors.full_name && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.full_name}
                                            </div>
                                        )}
                                    </div>{" "}
                                    <div className="col-md-6  mb-2">
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="preferred_name"
                                            placeholder="Preferred Name"
                                            value={data.preferred_name}
                                            onChange={handleChange}
                                        />
                                        {errors.preferred_name && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.preferred_name}
                                            </div>
                                        )}
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-12  mb-2">
                                        <input
                                            type="email"
                                            className="form-control"
                                            id="email"
                                            placeholder="Email"
                                            value={data.email}
                                            onChange={handleChange}
                                        />
                                        {errors.email && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.email}
                                            </div>
                                        )}
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-6  mb-2">
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="mobile_number"
                                            placeholder="Mobile Number"
                                            value={data.mobile_number}
                                            onChange={handleChange}
                                        />
                                        {errors.mobile_number && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.mobile_number}
                                            </div>
                                        )}
                                    </div>
                                    <div
                                        className="col-md-6 mb-2"
                                        style={{
                                            position: "relative",
                                            cursor: "pointer",
                                        }}
                                    >
                                        <input
                                            type="password"
                                            className="form-control"
                                            id="password"
                                            placeholder="Set a Password"
                                            value={data.password}
                                            onChange={handleChange}
                                        />
                                        <FaEyeSlash
                                            style={{
                                                position: "absolute",
                                                top: "50%",
                                                right: "30px",
                                                transform: errors.password
                                                    ? "translateY(-100%)"
                                                    : "translateY(-50%)",
                                            }}
                                            onClick={() => {
                                                const input =
                                                    document.querySelector(
                                                        "#password"
                                                    );
                                                input.type =
                                                    input.type === "password"
                                                        ? "text"
                                                        : "password";
                                            }}
                                        />
                                        {errors.password && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.password}
                                            </div>
                                        )}
                                    </div>
                                </div>
                                <div className="row">
                                    <div
                                        className="col-md-6  mb-2"
                                        style={{ position: "relative" }}
                                    >
                                        <Flatpickr
                                            className="form-control"
                                            id="date_of_birth"
                                            placeholder="Date of Birth"
                                            value={data.date_of_birth}
                                            onChange={(date) =>
                                                setData({
                                                    ...data,
                                                    date_of_birth: date[0],
                                                })
                                            }
                                            options={{
                                                dateFormat: "j F Y",
                                            }}
                                        />
                                        <FaCalendarAlt
                                            style={{
                                                position: "absolute",
                                                top: "50%",
                                                right: "30px",
                                                transform: errors.date_of_birth
                                                    ? "translateY(-100%)"
                                                    : "translateY(-50%)",
                                            }}
                                        />
                                        {errors.date_of_birth && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.date_of_birth}
                                            </div>
                                        )}
                                    </div>
                                    <div className="col-md-6">
                                        <Select
                                            className="form-control"
                                            id="gender"
                                            placeholder="Gender"
                                            selected={data.gender}
                                            onChange={(selected) =>
                                                setData({
                                                    ...data,
                                                    gender: selected.value,
                                                })
                                            }
                                            options={[
                                                {
                                                    value: "Male",
                                                    label: "Male",
                                                },
                                                {
                                                    value: "Female",
                                                    label: "Female",
                                                },
                                            ]}
                                        />
                                        {errors.gender && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.gender}
                                            </div>
                                        )}
                                    </div>
                                </div>
                                <div className="row">
                                    <div
                                        className="col-md-12  mb-2"
                                        style={{ position: "relative" }}
                                    >
                                        <Flatpickr
                                            className="form-control"
                                            id="date_of_joining"
                                            placeholder="When did you join BAT?"
                                            value={data.date_of_joining}
                                            onChange={(date) =>
                                                setData({
                                                    ...data,
                                                    date_of_joining: date[0],
                                                })
                                            }
                                            options={{
                                                dateFormat: "j F Y",
                                            }}
                                        />
                                        <FaCalendarAlt
                                            style={{
                                                position: "absolute",
                                                top: "50%",
                                                right: "30px",
                                                transform:
                                                    errors.date_of_joining
                                                        ? "translateY(-100%)"
                                                        : "translateY(-50%)",
                                            }}
                                        />
                                        {errors.date_of_joining && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.date_of_joining}
                                            </div>
                                        )}
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-5 mb-2">
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="function"
                                            placeholder="Which Function?"
                                            value={data.function}
                                            onChange={handleChange}
                                        />
                                        {errors.function && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.function}
                                            </div>
                                        )}
                                    </div>
                                    <div
                                        className="col-md-7 mb-2"
                                        style={{ position: "relative" }}
                                    >
                                        <Flatpickr
                                            className="form-control"
                                            id="date_of_leaving"
                                            placeholder="When did you leave?"
                                            value={data.date_of_leaving}
                                            onChange={(date) =>
                                                setData({
                                                    ...data,
                                                    date_of_leaving: date[0],
                                                })
                                            }
                                            options={{
                                                dateFormat: "j F Y",
                                            }}
                                        />
                                        <FaCalendarAlt
                                            style={{
                                                position: "absolute",
                                                top: "50%",
                                                right: "30px",
                                                transform:
                                                    errors.date_of_leaving
                                                        ? "translateY(-100%)"
                                                        : "translateY(-50%)",
                                            }}
                                        />
                                        {errors.date_of_leaving && (
                                            <div
                                                className="text-danger"
                                                style={{ fontSize: "12px" }}
                                            >
                                                {errors.date_of_leaving}
                                            </div>
                                        )}
                                    </div>
                                </div>
                                <p className="my-3">
                                    By clicking Sign Up, you agree to our Terms,
                                    Privacy Policy and Cookies Policy
                                </p>
                                <div className="row mt-4 mb-5 align-items-center">
                                    <div className="col-sm-6">
                                        <button
                                            type="submit"
                                            className="btn btn-round btn-gray bg-gray text-light px-5 py-2 fs-20"
                                            disabled={processing}
                                        >
                                            Sign Up
                                        </button>
                                    </div>
                                </div>

                                <p className="mt-5 text-center text-xl-start">
                                    Already have an account?{" "}
                                    <Link
                                        href="/login"
                                        className="text-dark fw-semibold"
                                    >
                                        Login
                                    </Link>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <div className="container">
                    <div className="row">
                        <div className="col-lg-4 mb-4 mb-lg-0">
                            <p className="footer-text fw-semibold">
                                © 2024 - <br /> Beyond BATBD. All rights
                                reserved
                            </p>
                        </div>
                        <div className="col-lg-4 mb-4 mb-lg-0">
                            <p className="footer-text">
                                <span className="text-muted">Designed by</span>{" "}
                                <i>Intelligent Machines</i> <br />{" "}
                                <span className="text-muted">Built by</span>{" "}
                                <i>Webbly Solutions</i>
                            </p>
                        </div>
                        <div className="col-lg-4 mb-4">
                            <p className="footer-text">
                                <span className="fw-semibold">
                                    Special thanks to
                                </span>{" "}
                                <br /> Shafayet Kamal Shiddiki
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    );
};

export default Register;
