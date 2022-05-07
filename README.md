
php artisan migrate
php artisan serve

https://documenter.getpostman.com/view/18808861/UyxdKpH6


    {
            "status": true,
            "message": "Comments list succesfull",
            "data": [
        {
                "id": 6,
                "name": "Joseph Yakuto",
                "comment": "Why bad 2 ?",
                "post_id": 1,
                    "parent_id": 0,
                    "comments": [
                        {
                            "id": 7,
                            "name": "Rıza Acilsoy",
                            "comment": "Maybe?",
                            "post_id": 1,
                            "parent_id": 6,
                            "comments": [
                                {
                                    "id": 8,
                                    "name": "Aleni Selen",
                                    "comment": "Trying?",
                                    "post_id": 1,
                                    "parent_id": 7
                                }
                            ]
                        }
                    ]
                },
                {
                    "id": 1,
                    "name": "Allisa Yellow",
                    "comment": "This is not good",
                    "post_id": 1,
                    "parent_id": 0,
                    "comments": [
                        {
                            "id": 2,
                            "name": "John Doe",
                            "comment": "This is not awsome",
                            "post_id": 1,
                            "parent_id": 1,
                            "comments": [
                                {
                                    "id": 4,
                                    "name": "Joseph Yakuto",
                                    "comment": "Why bad ?",
                                    "post_id": 1,
                                    "parent_id": 2
                                },
                                {
                                    "id": 5,
                                    "name": "Joseph Yakuto",
                                    "comment": "Why bad ?",
                                    "post_id": 1,
                                    "parent_id": 2
                                }
                            ]
                        },
                        {
                            "id": 3,
                            "name": "Lisa Zimmerman",
                            "comment": "This is not awsome",
                            "post_id": 1,
                            "parent_id": 1,
                            "comments": []
                        }
                    ]
                }
            ]
        }
