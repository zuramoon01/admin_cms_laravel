<x-dashboard.layout :name="$name" :menu="$menu">

    <!-- DataTales Example -->
    <div class="card shadow mb-4 datatable">
        <div class="card-header py-3 d-flex justify-content-between">
            <div>
                <select id="role" name="role" class="custom-select" onchange="changeDataTable(this)">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-warning" onclick="updateAuthorization(this)">
                <i class="fas fa-fw fa-spinner"></i>
                Update
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const dataTable = document.querySelector('.datatable');
        const roleSelect = document.querySelector('#role');
        let roleSelected = roleSelect.selectedOptions[0]

        const getTable = () => {
            fetch(`/api/authorizations/${roleSelected.value}`)
                .then((res) => res.json())
                .then((data) => {
                    const table = dataTable.children[1]

                    if (table) {
                        table.remove()
                    }

                    dataTable.innerHTML += data
                })
                .catch((err) => console.log(err))
        }
        getTable()

        const changeDataTable = (e) => {
            roleSelected = e.selectedOptions[0]
            getTable()
        }

        const updateAuthorization = (e) => {
            let role = []
            let menu = []
            let viewMenu = []
            let addMenu = []
            let editMenu = []
            let deleteMenu = []

            const tbody = [...document.querySelector('tbody').children];
            tbody.map((tr) => {
                tr = [...tr.children]

                const viewCheck = tr[1].children[0].children[0]
                const addCheck = tr[2].children[0].children[0]
                const editCheck = tr[3].children[0].children[0]
                const deleteCheck = tr[4].children[0].children[0]

                role.push(roleSelected.value)
                menu.push({
                    ...tr[0].dataset
                } ['id']);
                viewMenu.push(viewCheck.checked ? 1 : 0)
                addMenu.push(addCheck.checked ? 1 : 0)
                editMenu.push(editCheck.checked ? 1 : 0)
                deleteMenu.push(deleteCheck.checked ? 1 : 0)
            })

            axios.get(`authorizations/update`, {
                    params: {
                        role,
                        menu,
                        viewMenu,
                        addMenu,
                        editMenu,
                        deleteMenu,
                    }
                })
                .then((res) => console.log(res.data))
                .catch((err) => console.log(err))
        }
    </script>

</x-dashboard.layout>
