<template>
  <div>
    <v-app>
      <v-container class="grey lighten-5">
        <v-row
          v-for="n in 1"
          :key="n"
          :class="n === 1 ? 'mb-6' : ''"
          no-gutters
        >
          <v-col v-for="k in n + 0" :key="k">
            <v-card class="pa-2" outlined tile>
              <h3 class="font-weight-bold text-h3 text-center">Product</h3>
              <v-card-title>
                <v-dialog
                  v-model="dialog"
                  max-width="600px"
                  hide-overlay
                  no-click-animation
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn small color="success" dark v-bind="attrs" v-on="on">
                      Tambah Product
                    </v-btn>
                  </template>
                  <v-card>
                    <v-card-title>
                      <span class="text-h5">Crete Product</span>
                    </v-card-title>
                    <v-card-text>
                      <v-container>
                        <form action="">
                          <v-row>
                            <v-col cols="12">
                              <v-text-field
                                v-model="name"
                                label="Product Name"
                                type="text"
                                required
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                              <v-text-field
                                v-model="price"
                                label="Price"
                                type="number"
                                prefix="Rp."
                                required
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                              <v-text-field
                                v-model="color"
                                label="Color"
                                type="text"
                                required
                              ></v-text-field>
                            </v-col>

                            <v-col cols="12">
                              <v-select
                                :items="['Active', 'Non-active']"
                                v-model="status"
                                label="Status"
                                required
                              ></v-select>
                            </v-col>
                          </v-row>
                        </form>
                      </v-container>
                    </v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="dialog = false">
                        Back
                      </v-btn>
                      <v-btn color="success" @click="simpanProduct()">
                        Save
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
                <v-spacer></v-spacer>
                <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="Search"
                  single-line
                  hide-details
                ></v-text-field>
              </v-card-title>
              <v-data-table
                :headers="headers"
                :items="desserts"
                :search="search"
                :footer-props="{
                  itemsPerPageOptions: [10, 25, 50, 100],
                }"
              >
                <template v-slot:[`item.actions`]="{ item }">
                  <v-dialog
                    v-model="dialog2"
                    max-width="600px"
                    :retain-focus="false"
                    hide-overlay
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        small
                        color="warning"
                        dark
                        v-bind="attrs"
                        v-on="on"
                        @click="editItem(item.id)"
                      >
                        Update
                      </v-btn>
                    </template>
                    <v-card>
                      <v-card-title>
                        <span class="text-h5">Update Product</span>
                      </v-card-title>
                      <v-card-text>
                        <v-container>
                          <form action="">
                            <v-row>
                              <v-col cols="12">
                                <v-text-field
                                  v-model="editName"
                                  label="Product Name"
                                  type="text"
                                  required
                                ></v-text-field>
                              </v-col>
                              <v-col cols="12">
                                <v-text-field
                                  v-model="editPrice"
                                  label="Price"
                                  type="number"
                                  prefix="Rp."
                                  required
                                ></v-text-field>
                              </v-col>
                              <v-col cols="12">
                                <v-text-field
                                  v-model="editColor"
                                  label="Color"
                                  type="text"
                                  required
                                ></v-text-field>
                              </v-col>

                              <v-col cols="12">
                                <v-select
                                  :items="['Active', 'Non-active']"
                                  v-model="editStatus"
                                  label="Status"
                                  required
                                ></v-select>
                              </v-col>
                            </v-row>
                          </form>
                        </v-container>
                      </v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="dialog2 = false"
                        >
                          Back
                        </v-btn>
                        <v-btn color="success" @click="updateItem()">
                          Update
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>

                  <v-btn
                    small
                    color="error"
                    @click.prevent="deleteItem(item.id)"
                  >
                    Delete
                  </v-btn>

                  <v-dialog
                    v-model="dialog4"
                    max-width="600px"
                    :retain-focus="false"
                    hide-overlay
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        small
                        color="info"
                        dark
                        v-bind="attrs"
                        v-on="on"
                        @click="showItem(item.id)"
                      >
                        Show
                      </v-btn>
                    </template>
                    <v-card>
                      <v-card-title>
                        <span class="text-h5">Show Product</span>
                      </v-card-title>
                      <v-card-text>
                        <v-container>
                          <form action="">
                            <v-row>
                              <v-col cols="12">
                                <v-text-field
                                  v-model="showName"
                                  label="Product Name"
                                  type="text"
                                  readonly
                                  outlined
                                ></v-text-field>
                              </v-col>
                              <v-col cols="12">
                                <v-text-field
                                  v-model="showPrice"
                                  label="Price"
                                  type="number"
                                  prefix="Rp."
                                  readonly
                                  outlined
                                ></v-text-field>
                              </v-col>
                              <v-col cols="12">
                                <v-text-field
                                  v-model="showColor"
                                  label="Color"
                                  type="text"
                                  readonly
                                  outlined
                                ></v-text-field>
                              </v-col>

                              <v-col cols="12">
                                <v-select
                                  :items="['Active', 'Non-active']"
                                  v-model="showStatus"
                                  label="Status"
                                  readonly
                                  outlined
                                ></v-select>
                              </v-col>
                            </v-row>
                          </form>
                        </v-container>
                      </v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="dialog4 = false"
                        >
                          Back
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </template>
              </v-data-table>
            </v-card>
          </v-col>
        </v-row>
        <v-row
          v-for="x in 1"
          :key="x"
          :class="x === 1 ? 'mb-6' : ''"
          no-gutters
        >
          <v-col v-for="y in x + 0" :key="y">
            <v-card class="pa-2" outlined tile>
              <form action="">
                <v-container>
                  <v-row>
                    <v-col cols="12" md="6">
                      <v-select
                        v-model="select"
                        :items="['Active', 'Non-active']"
                        label="Status"
                        required
                      ></v-select
                    ></v-col>
                    <v-col cols="12" md="6" class="mt-5">
                      <v-btn color="blue darken-1" text @click="cariStatus()">
                        Cari
                      </v-btn></v-col
                    >
                  </v-row>
                </v-container>
              </form>

              <v-data-table
                :headers="headers2"
                :items="cariStatusProduct"
                :items-per-page="5"
                class="elevation-1"
              ></v-data-table>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-app>
  </div>
</template>
    
<script>
export default {
  data: () => ({
    dialog: false,
    dialog2: false,
    dialog3: false,
    dialog4: false,
    search: "",
    overlay: false,

    product: {},
    desserts: [],
    cariStatusProduct: [],

    foodType: null,

    name: "",
    price: "",
    color: "",
    status: "",
    select: "",
    editId: "",
    editName: "",
    editPrice: "",
    editColor: "",
    editStatus: "",
    showId: "",
    showName: "",
    showPrice: "",
    showColor: "",
    showStatus: "",
    foodType: "",

    headers: [
      { text: "Number", value: "id" },
      { text: "Name", value: "name" },
      { text: "Price", value: "price" },
      { text: "Color", value: "color" },
      { text: "Status", value: "status" },
      { text: "action", value: "actions" },
    ],
    headers2: [
      { text: "Number", value: "id" },
      { text: "Name", value: "name" },
      { text: "Price", value: "price" },
      { text: "Color", value: "color" },
      { text: "Status", value: "status" },
    ],
  }),

  created() {
    this.getItems();
  },
  carii() {
    this.cariStatus();
  },

  methods: {
    simpanProduct() {
      axios
        .post("simpan_Product", {
          name: this.name,
          price: this.price,
          color: this.color,
          status: this.status,
        })
        .then((response) => {
          console.log(response.data.message);
          window.location.reload();
        });
    },
    getItems() {
      axios.get("ambil_semua_product").then((response) => {
        console.log(response.data);
        this.desserts = response.data;
      });
    },
    editItem(id) {
      axios.get("edit_product/" + id).then((response) => {
        this.editId = response.data.id;
        this.editName = response.data.name;
        this.editPrice = response.data.price;
        this.editColor = response.data.color;
        this.editStatus = response.data.status;
      });
    },
    updateItem() {
      axios
        .put("update_product", {
          id: this.editId,
          name: this.editName,
          price: this.editPrice,
          color: this.editColor,
          status: this.editStatus,
        })
        .then((response) => {
          window.location.reload();
        });
    },
    deleteItem(id) {
      axios.delete("hapus_product/" + id).then((response) => {
        console.log(response.data.message);
        window.location.reload();
      });
    },
    showItem(id) {
      axios.get("show_product/" + id).then((response) => {
        this.showId = response.data.id;
        this.showName = response.data.name;
        this.showPrice = response.data.price;
        this.showColor = response.data.color;
        this.showStatus = response.data.status;
      });
    },

    cariStatus() {
      console.log(this.select);
      axios.get("cari_status").then((response) => {
        console.log(response.data);
        this.cariStatusProduct = response.data;
      });
    },
  },
};
</script>