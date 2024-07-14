import React, { useState, useEffect } from "react";
import Layout from "../Components/Layout";
import { format } from "date-fns";
import Select from "react-select";
import { BiSearch } from "react-icons/bi";
import { Link } from "@inertiajs/react";
import { Pagination } from "react-bootstrap";
import AccountNotVerified from "../Components/AccountNotVerified";

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
            const label = link.label
                .replace("&laquo;", "«")
                .replace("&raquo;", "»");
            const isDisabled = link.url === null;
            const isActive = link.active;

            return (
                <Pagination.Item
                    key={label}
                    active={isActive}
                    disabled={isDisabled}
                    onClick={() => {
                        if (!isDisabled) {
                            window.location.href = link.url;
                        }
                    }}
                >
                    <span dangerouslySetInnerHTML={{ __html: label }} />
                </Pagination.Item>
            );
        });
    };

    if (user.account_verified_at === null) {
        return (
            <Layout>
                <AccountNotVerified />
            </Layout>
        );
    }

    return (
        <Layout>
            <div style={{ backgroundColor: "#F5F5F5", minHeight: "100vh" }}>
                <div className="site-container">
                    <div className="py-5">
                        <div className="card p-2">
                            <div className="card-body">
                                <div className="row">
                                    <h3 className="col-12 col-md-6 ps-4 text-center-mobile">
                                        Members
                                    </h3>
                                    <div className="col-12 col-md-6 row">
                                        <div className="col-12 col-md-6 d-flex align-items-center mb-3 mb-md-0">
                                            <form
                                                onSubmit={handleSearchSubmit}
                                                style={{ width: "100%" }}
                                            >
                                                <div
                                                    style={{
                                                        position: "relative",
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
                                                            width: "100%",
                                                            paddingRight:
                                                                "40px",
                                                            fontSize: 14,
                                                        }}
                                                    />
                                                    <button
                                                        type="submit"
                                                        style={{
                                                            border: "none",
                                                            background: "none",
                                                            position:
                                                                "absolute",
                                                            right: "10px",
                                                            top: "50%",
                                                            transform:
                                                                "translateY(-50%)",
                                                            padding: 0,
                                                        }}
                                                    >
                                                        <BiSearch
                                                            style={{
                                                                fontSize:
                                                                    "20px",
                                                                color: "#000000BF",
                                                            }}
                                                        />
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                        <div
                                            className="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start"
                                            style={{ fontSize: 14 }}
                                        >
                                            <p className="pe-3 mb-0">
                                                Sort By:
                                            </p>
                                            <Select
                                                name=""
                                                id=""
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
                                                style={{ width: "1000px" }}
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
                                                className="col-6 col-md-3"
                                                style={{
                                                    textDecoration: "none",
                                                }}
                                            >
                                                <div className="mb-4 text-center">
                                                    <img
                                                        src={
                                                            user.profile_image ??
                                                            "https://picsum.photos/113"
                                                        }
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

                                    {users.data?.length === 0 && (
                                        <div className="text-center w-100">
                                            <h3>No members found</h3>
                                        </div>
                                    )}
                                </div>

                                <div className="d-flex justify-content-end mt-4">
                                    {users.data?.length !== 0 && (
                                        <Pagination>
                                            {renderPagination()}
                                        </Pagination>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    );
};

export default Members;
