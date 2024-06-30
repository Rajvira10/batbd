import React, { useState, useEffect } from "react";
import Layout from "../Components/Layout";
import { format } from "date-fns";
import Select from "react-select";
import { BiSearch } from "react-icons/bi";
import { Link, usePage } from "@inertiajs/react";

const Members = ({ users, search, sort, user }) => {
    const [searchQuery, setSearchQuery] = useState(search || "");
    const [sortOption, setSortOption] = useState(sort || "");

    const handleSearchChange = (e) => {
        setSearchQuery(e.target.value);
    };

    const handleSortChange = (selectedOption) => {
        setSortOption(selectedOption.value);
        const url = new URL(window.location.href);
        url.searchParams.set("sort", selectedOption.value);
        window.location.href = url.toString();
    };

    const handleSearchSubmit = (e) => {
        e.preventDefault();
        const url = new URL(window.location.href);
        url.searchParams.set("search", searchQuery);
        window.location.href = url.toString();
    };

    const renderPagination = () => {
        return users.links.map((link) => {
            return (
                <Link href={link.url} key={link.label}>
                    <li className="page-item">
                        <p
                            className="page-link"
                            dangerouslySetInnerHTML={{ __html: link.label }}
                        ></p>
                    </li>
                </Link>
            );
        });
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
            <div style={{ backgroundColor: "#F5F5F5", minHeight: "100vh" }}>
                <div className="" style={{ width: "70%", margin: "0 auto" }}>
                    <div className="py-5">
                        <div className="card p-2">
                            <div className="card-body">
                                <div className="row">
                                    <h3 className="col-md-6 ps-4">Members</h3>
                                    <div className="col-md-6 row">
                                        <div className="col-md-6 d-flex align-items-center position-relative">
                                            <form
                                                onSubmit={handleSearchSubmit}
                                                style={{
                                                    display: "flex",
                                                    width: "100%",
                                                }}
                                            >
                                                <input
                                                    type="text"
                                                    className="form-control"
                                                    placeholder="Search"
                                                    value={searchQuery}
                                                    onChange={
                                                        handleSearchChange
                                                    }
                                                    style={{
                                                        width: "300px",
                                                        fontSize: 14,
                                                    }}
                                                />
                                                <button
                                                    type="submit"
                                                    style={{
                                                        border: "none",
                                                        background: "none",
                                                        position: "absolute",
                                                        right: "18px",
                                                        top: "8px",
                                                    }}
                                                >
                                                    <BiSearch
                                                        style={{
                                                            fontSize: "20px",
                                                            color: "#000000BF",
                                                        }}
                                                    />
                                                </button>
                                            </form>
                                        </div>

                                        <div
                                            className="col-md-6 d-flex align-items-center"
                                            style={{ fontSize: 14 }}
                                        >
                                            <p className="pe-3">Sort By:</p>{" "}
                                            <Select
                                                name=""
                                                id=""
                                                className=""
                                                options={[
                                                    {
                                                        value: "date_of_joining",
                                                        label: "Joining Date",
                                                    },
                                                    {
                                                        value: "date_of_birth",
                                                        label: "Date of Birth",
                                                    },
                                                ]}
                                                value={
                                                    sortOption
                                                        ? {
                                                              value: sortOption,
                                                              label:
                                                                  sortOption ===
                                                                  "date_of_joining"
                                                                      ? "Joining Date"
                                                                      : sortOption ===
                                                                            "date_of_birth" &&
                                                                        "Date of Birth",
                                                          }
                                                        : null
                                                }
                                                onChange={handleSortChange}
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div className="row mt-4">
                                    {users.data?.length !== 0 &&
                                        users.data.map((user) => (
                                            <Link
                                                href={`/members/${user.id}`}
                                                key={user.id}
                                                className="col-md-3"
                                                style={{
                                                    textDecoration: "none",
                                                }}
                                            >
                                                <div className="mb-4 text-center">
                                                    <img
                                                        src={user.profile_image}
                                                        alt={user.full_name}
                                                        height={113}
                                                        width={113}
                                                        style={{
                                                            borderRadius:
                                                                "33px",
                                                            objectFit: "cover",
                                                        }}
                                                    />
                                                    <p
                                                        className="mt-3"
                                                        style={{
                                                            fontWeight: "bold",
                                                        }}
                                                    >
                                                        {user.full_name}
                                                    </p>
                                                    <p
                                                        style={{
                                                            fontSize: "12px",
                                                            color: "#000000BF",
                                                        }}
                                                    >
                                                        {format(
                                                            new Date(
                                                                user.date_of_joining
                                                            ),
                                                            "yyyy"
                                                        )}{" "}
                                                        -{" "}
                                                        {format(
                                                            new Date(
                                                                user.date_of_birth
                                                            ),
                                                            "yyyy"
                                                        )}
                                                    </p>
                                                </div>
                                            </Link>
                                        ))}
                                </div>

                                <nav>
                                    <ul className="pagination justify-content-center mt-4">
                                        {renderPagination()}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    );
};

export default Members;
