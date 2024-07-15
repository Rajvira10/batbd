import { Link, useForm, usePage } from "@inertiajs/react";
import React, { useState, useEffect } from "react";
import { toast } from "react-toastify";

const ForgotPassword = () => {
    const { props } = usePage();
    const { message } = props.flash;
    console.log(message);
    const { data, setData, post, processing, errors } = useForm({
        email: "",
    });

    useEffect(() => {
        if (message?.type === "success") {
            toast.success(message.content);
        }
        if (message?.type === "danger") {
            toast.error(message.content);
        }
    }, [message]);

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/forgot-password", {
            email,
        });
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
                            <div className="card-body">
                                <h4>Forgot Password</h4>
                                <p className="mt-3">
                                    Enter your email address below and we will
                                    send you instructions on how to reset your
                                    password.
                                </p>
                                <form onSubmit={handleSubmit} className="mt-3">
                                    <div className="mb-3">
                                        <label
                                            htmlFor="email"
                                            className="form-label"
                                        >
                                            Email
                                        </label>
                                        <input
                                            type="email"
                                            className="form-control"
                                            id="email"
                                            value={data.email}
                                            onChange={(e) =>
                                                setData("email", e.target.value)
                                            }
                                            required
                                        />
                                    </div>
                                    <button
                                        type="submit"
                                        className="btn btn-round btn-gray bg-gray text-light px-5 py-2 fs-20"
                                    >
                                        Send Reset Link
                                    </button>
                                </form>
                            </div>
                            <div className="card-footer mt-5">
                                <p>
                                    Remembered your password?{" "}
                                    <Link href="/login">Go back to login</Link>
                                </p>
                            </div>
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

export default ForgotPassword;
