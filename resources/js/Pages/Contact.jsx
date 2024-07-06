import React from "react";
import Layout from "../Components/Layout";
import { useForm } from "@inertiajs/react";

const Contact = () => {
    const { data, setData, post, processing, errors } = useForm({
        name: "",
        email: "",
        phone_number: "",
        subject: "",
        message: "",
    });
    return (
        <Layout>
            <div className="pt-5"></div>
            <div className="card mb-5 contact-container">
                <div className="card-body p-5 ">
                    <h4 className="text-center">Contact</h4>
                    <br />
                    <form
                        onSubmit={(e) => {
                            e.preventDefault();
                            post("/contact");
                        }}
                    >
                        <div className="mb-3">
                            <label htmlFor="name" className="form-label">
                                Name
                            </label>
                            <input
                                type="text"
                                className="form-control py-3"
                                style={{ borderRadius: "15px" }}
                                id="name"
                                placeholder="Name"
                                value={data.name}
                                onChange={(e) =>
                                    setData("name", e.target.value)
                                }
                            />
                        </div>
                        <div className="mb-3">
                            <label htmlFor="email" className="form-label">
                                Email
                            </label>
                            <input
                                type="email"
                                placeholder="Email"
                                className="form-control py-3"
                                style={{ borderRadius: "15px" }}
                                id="email"
                                value={data.email}
                                onChange={(e) =>
                                    setData("email", e.target.value)
                                }
                            />
                        </div>
                        <div className="mb-3">
                            <label
                                htmlFor="phone_number"
                                className="form-label"
                            >
                                Phone Number
                            </label>
                            <input
                                type="text"
                                className="form-control py-3"
                                style={{ borderRadius: "15px" }}
                                id="phone_number"
                                placeholder="Phone Number"
                                value={data.phone_number}
                                onChange={(e) =>
                                    setData("phone_number", e.target.value)
                                }
                            />
                        </div>
                        <div className="mb-3">
                            <label htmlFor="subject" className="form-label">
                                Subject
                            </label>
                            <input
                                type="text"
                                className="form-control py-3"
                                style={{ borderRadius: "15px" }}
                                id="subject"
                                placeholder="Subject"
                                value={data.subject}
                                onChange={(e) =>
                                    setData("subject", e.target.value)
                                }
                            />
                        </div>
                        <div className="mb-3">
                            <label htmlFor="message" className="form-label">
                                Message
                            </label>
                            <textarea
                                className="form-control py-3"
                                style={{ borderRadius: "15px" }}
                                id="message"
                                rows="3"
                                placeholder="Message"
                                value={data.message}
                                onChange={(e) =>
                                    setData("message", e.target.value)
                                }
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            className="btn btn-light w-100 py-2"
                            style={{ color: "#0E2B63" }}
                            disabled={processing}
                        >
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </Layout>
    );
};

export default Contact;
