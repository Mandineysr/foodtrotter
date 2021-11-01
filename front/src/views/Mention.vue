<template>
  <div>
    <section>
      <v-row align="center" justify="space-around">
        <v-card class="mx-auto" max-width="344" outlined>
          <v-list-item three-line>
            <v-list-item-content>
              <div class="overline mb-4">Article 1</div>
              <v-list-item-title class="headline mb-1">
                Foodtrotter
              </v-list-item-title>
              <v-list-item-title class="headline mb-1"> </v-list-item-title>
              <v-list-item-subtitle
                >On se creuse la cervelle, pour trouver nos recettes.
              </v-list-item-subtitle>
            </v-list-item-content>
            <v-img
              lazy-src="https://picsum.photos/id/11/10/6"
              max-height="100"
              max-width="100"
              src="../assets/cerveau.svg"
            ></v-img>
          </v-list-item>

          <v-card-actions>
            <v-col cols="auto">
              <v-dialog transition="dialog-top-transition" max-width="600">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="primary" v-bind="attrs" v-on="on"
                    >Tout sur nos recettes</v-btn
                  >
                </template>
                <template v-slot:default="dialog">
                  <v-card>
                    <v-toolbar color="primary" dark
                      >Des ingrédients au TOP !</v-toolbar
                    >
                    <v-card-text>
                      <v-img
                        lazy-src="https://picsum.photos/id/11/10/6"
                        max-height="300"
                        max-width="300"
                        src="../assets/asticotfrais.svg"
                      ></v-img>
                      <div class="text-h5 pa-12">
                        Vous pouvez être sur de la fraicheur de nos ingrédients.
                        Ils sont issus pour la plupart de la meilleur partie de
                        la viande.
                      </div>
                    </v-card-text>
                    <v-card-actions class="justify-end">
                      <v-btn text @click="dialog.value = false">Fermer</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
            </v-col>
          </v-card-actions>
        </v-card>
        <v-card class="mx-auto" max-width="344" outlined>
          <v-list-item three-line>
            <v-list-item-content>
              <div class="overline mb-4">Article2</div>
              <v-list-item-title class="headline mb-1">
                Foodtrotter
              </v-list-item-title>
              <v-list-item-subtitle
                >Nous prenons soin de nos animaux</v-list-item-subtitle
              >
            </v-list-item-content>

            <v-img
              lazy-src="https://picsum.photos/id/11/10/6"
              max-height="100"
              max-width="100"
              src="../assets/insectes.svg"
            ></v-img>
          </v-list-item>

          <v-card-actions>
            <v-col cols="auto">
              <v-dialog transition="dialog-top-transition" max-width="600">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="primary" v-bind="attrs" v-on="on"
                    >Tout sur notre elevage</v-btn
                  >
                </template>
                <template v-slot:default="dialog">
                  <v-card>
                    <v-toolbar color="primary" dark
                      >Stop au gavage !!</v-toolbar
                    >
                    <v-card-text>
                      <v-img
                        lazy-src="https://picsum.photos/id/11/10/6"
                        max-height="300"
                        max-width="300"
                        src="../assets/insectes1.svg"
                      ></v-img>
                      <div class="text-h5 pa-12">
                        Nous prenons soin de bien nourrir vos prochains repas,
                        pour de copieux et savoureux plats !
                      </div>
                    </v-card-text>
                    <v-card-actions class="justify-end">
                      <v-btn text @click="dialog.value = false">Fermer</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
            </v-col>
          </v-card-actions>
        </v-card>

        <v-card class="mx-auto" max-width="344" outlined>
          <v-list-item three-line>
            <v-list-item-content>
              <div class="overline mb-4">Article 3</div>
              <v-list-item-title class="headline mb-1">
                Foodtrotter
              </v-list-item-title>
              <v-list-item-subtitle
                >En cas de nausées, changez tout de suite de
                site.</v-list-item-subtitle
              >
            </v-list-item-content>

            <v-img
              lazy-src="https://picsum.photos/id/11/10/6"
              max-height="100"
              max-width="100"
              src="../assets/vomir.png"
            ></v-img>
          </v-list-item>

          <v-card-actions>
            <v-col cols="auto">
              <v-dialog transition="dialog-top-transition" max-width="600">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="primary" v-bind="attrs" v-on="on"
                    >Lire en cas de nausées.</v-btn
                  >
                </template>
                <template v-slot:default="dialog">
                  <v-card>
                    <v-toolbar color="primary" dark
                      >En cas de nausées.</v-toolbar
                    >
                    <v-card-text>
                      <v-img
                        lazy-src="https://picsum.photos/id/11/10/6"
                        max-height="300"
                        max-width="300"
                        src="../assets/nausees.svg"
                      ></v-img>
                      <div class="text-h5 pa-12">
                        Respirez profondément, fermez les yeux et essayez de
                        quitter le site les yeux fermés!! Sinon des petits
                        sachets sont à acheter dans la boutique souvenir.
                      </div>
                    </v-card-text>
                    <v-card-actions class="justify-end">
                      <v-btn text @click="dialog.value = false">Fermer</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
            </v-col>
          </v-card-actions>
        </v-card>

        <v-card class="mx-auto" max-width="344" outlined>
          <v-list-item three-line>
            <v-list-item-content>
              <div class="overline mb-4">Article 4</div>
              <v-list-item-title class="headline mb-1">
                Foodtrotter
              </v-list-item-title>
              <v-list-item-subtitle
                >Griller n'est pas joué !! en tout cas c'est moins
                risqué.</v-list-item-subtitle
              >
            </v-list-item-content>

            <v-img
              lazy-src="https://picsum.photos/id/11/10/6"
              max-height="100"
              max-width="100"
              src="../assets/scorpion.jpg"
            ></v-img>
          </v-list-item>

          <v-card-actions>
            <v-col cols="auto">
              <v-dialog transition="dialog-top-transition" max-width="600">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="primary" v-bind="attrs" v-on="on"
                    >La cuisson</v-btn
                  >
                </template>
                <template v-slot:default="dialog">
                  <v-card>
                    <v-toolbar color="primary" dark
                      >Petit conseil de cuisson</v-toolbar
                    >
                    <v-card-text>
                      <v-img
                        lazy-src="https://picsum.photos/id/11/10/6"
                        max-height="300"
                        max-width="300"
                        src="../assets/scorpionsgrille.svg"
                      ></v-img>
                      <div class="text-h5 pa-12">
                        On n'oublie pas de griller les larves avant de manger..
                        c'est plus fondant..croquant !!
                      </div>
                    </v-card-text>
                    <v-card-actions class="justify-end">
                      <v-btn text @click="dialog.value = false">Fermer</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
            </v-col>
          </v-card-actions>
        </v-card>
      </v-row>

      <v-row align="center" justify="space-around">
        <v-card class="mx-auto" max-width="344" outlined>
          <v-list-item three-line>
            <v-list-item-content>
              <div class="overline mb-4">Article 5</div>
              <v-list-item-title class="headline mb-1">
                Foodtrotter
              </v-list-item-title>
              <v-list-item-title class="headline mb-1"> </v-list-item-title>
              <v-list-item-subtitle
                >Les conditions d'utilisation du site
              </v-list-item-subtitle>
            </v-list-item-content>
            <v-img
              lazy-src="https://picsum.photos/id/11/10/6"
              max-height="100"
              max-width="100"
              src="../assets/cond.png"
            ></v-img>
          </v-list-item>

          <v-card-actions>
            <v-col cols="auto">
              <v-dialog transition="dialog-top-transition" max-width="600">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="primary" v-bind="attrs" v-on="on"
                    >Lire les condtions</v-btn
                  >
                </template>
                <template v-slot:default="dialog">
                  <v-card>
                    <v-toolbar color="primary" dark
                      >Conditions d'utilisation du site</v-toolbar
                    >
                    <v-card-text>
                      <div class="text-h5 pa-12">
                        L’utilisation du présent site implique l’acceptation
                        pleine et entière des conditions générales d’utilisation
                        décrites ci-après. Ces conditions d’utilisation sont
                        susceptibles d’être modifiées ou complétées à tout
                        moment. Ces conditions d’utilisation sont susceptibles
                        d’être modifiées ou complétées à tout moment.
                      </div>
                    </v-card-text>
                    <v-card-actions class="justify-end">
                      <v-btn text @click="dialog.value = false">Fermer</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
            </v-col>
          </v-card-actions>
        </v-card>
        <v-card class="mx-auto" max-width="344" outlined>
          <v-list-item three-line>
            <v-list-item-content>
              <div class="overline mb-4">Article6</div>
              <v-list-item-title class="headline mb-1">
                Foodtrotter
              </v-list-item-title>
              <v-list-item-subtitle
                >Informations générales présentées sur le
                site</v-list-item-subtitle
              >
            </v-list-item-content>

            <v-img
              lazy-src="https://picsum.photos/id/11/10/6"
              max-height="100"
              max-width="100"
              src="../assets/info.png"
            ></v-img>
          </v-list-item>

          <v-card-actions>
            <v-col cols="auto">
              <v-dialog transition="dialog-top-transition" max-width="600">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="primary" v-bind="attrs" v-on="on"
                    >Lire les Infos</v-btn
                  >
                </template>
                <template v-slot:default="dialog">
                  <v-card>
                    <v-toolbar color="primary" dark
                      >Informations Générales</v-toolbar
                    >
                    <v-card-text>
                      <div class="text-h5 pa-12">
                        Les informations et documents du site sont présentés à
                        titre indicatif, n’ont pas de caractère exhaustif, et ne
                        peuvent engager la responsabilité du propriétaire du
                        site. Le propriétaire du site ne peut être tenu
                        responsable des dommages directs et indirects
                        consécutifs à l’accès au site.
                      </div>
                    </v-card-text>
                    <v-card-actions class="justify-end">
                      <v-btn text @click="dialog.value = false">Fermer</v-btn>
                    </v-card-actions>
                  </v-card>
                </template>
              </v-dialog>
            </v-col>
          </v-card-actions>
        </v-card>
      </v-row>
    </section>
  </div>
</template>




<script>
</script>




<style lang="scss">
</style>

