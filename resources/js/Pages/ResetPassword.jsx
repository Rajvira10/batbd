import React, { useState } from "react";
import { useForm } from "@inertiajs/react";
import { toast } from "react-toastify";

const ResetPassword = ({ user }) => {
    const { data, setData, post, processing, errors } = useForm({
        password: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(`/reset-password/${user.id}`, {
            onSuccess: () => toast.success("Password reset successful!"),
            onError: () =>
                toast.error("There was an error resetting your password."),
        });
    };

    return (
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
                            <h4>Reset Password</h4>
                            <form onSubmit={handleSubmit}>
                                <div className="mb-3">
                                    <label
                                        htmlFor="password"
                                        className="form-label"
                                    >
                                        New Password
                                    </label>
                                    <input
                                        type="password"
                                        className="form-control"
                                        id="password"
                                        value={data.password}
                                        onChange={(e) =>
                                            setData("password", e.target.value)
                                        }
                                        required
                                    />
                                    {errors.password && (
                                        <div className="text-danger mt-2">
                                            {errors.password}
                                        </div>
                                    )}
                                </div>
                                <button
                                    type="submit"
                                    className="btn btn-primary"
                                    disabled={processing}
                                >
                                    {processing
                                        ? "Resetting..."
                                        : "Reset Password"}
                                </button>
                            </form>
                        </div>
                        <div className="card-footer mt-5">
                            <p>
                                Remembered your password?{" "}
                                <a href="/login">Go back to login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ResetPassword;
