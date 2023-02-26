<template>
    <ui5-page
        id="dashboard-page"
        background-design="List"
        style="height: 100vh"
    >
        <div
            class="fd-margin-top-bottom--tiny fd-has-display-flex fd-has-align-items-center"
            style="justify-content: space-between"
        >
            <div class="fd-has-display-flex">
                <div style="margin-left:10px">
                    <VSLabel>{{ user_name }}</VSLabel>
                </div>
                <div style="margin-left:20px">
                    <VSLabel
                        class="fd-margin-end--tiny"
                        show-colon=""
                    >
                        جمع ساعت کاری
                    </VSLabel>
                    <VSLabel>{{ myTotal }}</VSLabel>
                </div>
                <ui5-button icon="down" @click="menu_handler" id="btnOpenBasic">{{ $t('shift') }}</ui5-button>
                <br/>
                <ui5-menu id="menuBasic">
                    <ui5-menu-item text="لیست شیفت ها" icon="show" @click="create_shift_handler"></ui5-menu-item>
                    <ui5-menu-item text="تعریف شیفت" icon="add-document" @click="create_shift_handler"></ui5-menu-item>
                </ui5-menu>
            </div>

            <div class="fd-has-display-flex">
                <VSButton
                    class="fd-margin-end--tiny"
                    :disabled="!preventEnteringCheckOut"
                    design="Positive"
                    icon="media-play"
                    tooltip="ثبت ورود"
                    @click="enterNewCheckIn"
                >
                    ثبت ورود
                </VSButton>
                <!--                <VSButton-->
                <!--                    class="fd-margin-end&#45;&#45;tiny"-->
                <!--                    design="Negative"-->
                <!--                    icon="media-pause"-->
                <!--                    tooltip="ثبت خروج"-->
                <!--                    @click="enterNewCheckOut"-->
                <!--                >-->
                <!--                    ثبت خروج-->
                <!--                </VSButton>-->

                <!--                <VSButton-->
                <!--                    class="fd-margin-end&#45;&#45;tiny"-->
                <!--                    icon="add-document"-->
                <!--                    tooltip="ثبت تردد"-->
                <!--                    @click="showDialogById('add-new-record-dialog')"-->
                <!--                >-->
                <!--                    ثبت تردد...-->
                <!--                </VSButton>-->

                <VSButton
                    class="fd-margin-end--tiny"
                    icon="settings"
                    tooltip="تنظیمات"
                    @click="showDialogById('settings-dialog')"
                >
                    تنظیمات...
                </VSButton>
                <VSButton
                    class="fd-margin-end--tiny fd-margin-bottom--2 fd-margin-bottom--tiny-0"

                    design="Negative"
                    icon="log"
                    tooltip="خروج"
                    @click="logout_handler"
                >
                    خروج
                </VSButton>
            </div>
        </div>
        <table class="fd-table fd-table--no-horizontal-borders fd-table--no-vertical-borders">
            <thead class="fd-table__header">
            <tr class="fd-table__row">
                <th class="fd-table__cell" scope="col">{{ $t('date') }}</th>

                <th class="fd-table__cell" scope="col" >{{ $t('workspace name') }}</th>
                <th class="fd-table__cell" scope="col" >{{ $t('shift title') }}</th>
                <th class="fd-table__cell" scope="col" >{{ $t('time') }}</th>
                <th class="fd-table__cell" scope="col" >{{ $t('action') }}</th>
            </tr>
            </thead>
            <tbody class="fd-table__body" >
            <tr class="fd-table__row" v-for="(list,index) in result" :key="list.id">
                <td class="fd-table__cell">{{ dateSet(index) }}</td>
                <!--            <thead class="fd-table__header">-->
                <!--            <tr class="fd-table__row">-->

                <!--                <th class="fd-table__cell" scope="col">{{ $t('shift title') }}</th>-->
                <!--                <th class="fd-table__cell" scope="col">{{ $t('workspace name') }}</th>-->
                <!--                <th class="fd-table__cell" scope="col">{{ $t('action') }}</th>-->
                <!--            </tr>-->
                <!--            </thead>-->
                <td colspan="4">
            <tbody class="fd-table__body" style="display: table;width: 100%">
            <tr class="fd-table__cell" v-for="item in list" :key="item.id">
                <td class="fd-table__cell"> {{ item.department?.name }}</td>
                <td class="fd-table__cell">{{ item.shift?.title }}</td>
                <td class="fd-table__cell">{{ timeSet(item.date) }}</td>
                <td class="fd-table__cell"><button   class=" fd-button fd-button--positive">{{ $t('edit') }}</button></td>
                <td class="fd-table__cell"><button   class=" fd-button fd-button--negative ">{{ $t('delete') }}</button></td>

            </tr>
            </tbody>
            </td>

            </tr>
            </tbody>
        </table>
    </ui5-page>


    <ui5-dialog
        id="add-new-record-dialog"
        icon="decline"
        header-text="ثبت تردد"
    >
        <div slot="header">
            <ui5-title level="H4">
                ثبت تردد
            </ui5-title>
        </div>
        <div
            slot="header"
            class="fd-has-display-flex fd-margin-top-bottom--tiny"
            style="justify-content: end; width: 100%"
        >
            <ui5-button
                icon="decline"
                tooltip="بستن پنجره"
                design="Transparent"
                @click="closeDialogById('add-new-record-dialog')"
            />
        </div>

        <div class="fd-margin-begin-end--md">
            <ui5-label
                id="check-in-datetime-label"
                for="check-in-datetime"
                show-colon=""
            >
                زمان ورود
            </ui5-label>
            <div>
                <ui5-datetime-picker
                    id="check-in-datetime"
                    class="fd-margin-top-bottom--tiny"
                    format-pattern="yyyy-MM-dd HH:mm:ss"
                />
            </div>
        </div>

        <div class="fd-margin-begin-end--md">
            <ui5-label
                id="check-out-datetime-label"
                for="check-out-datetime"
                show-colon=""
            >
                زمان خروج
            </ui5-label>
            <div>
                <ui5-datetime-picker
                    id="check-out-datetime"
                    class="fd-margin-top-bottom--tiny"
                    format-pattern="yyyy-MM-dd HH:mm:ss"
                />
            </div>
        </div>

        <div
            slot="footer"
            class="fd-has-display-flex fd-has-align-items-center fd-margin-top-bottom--tiny"
            style="justify-content: end; width: 100%"
        >
            <ui5-button
                id="save-record-button"
                design="Emphasized"
                icon="save"
                @click="saveRecord"
            >
                ذخیره
            </ui5-button>
        </div>
    </ui5-dialog>

    <ui5-dialog
        id="edit-record-dialog"
        icon="decline"
        header-text="ویرایش تردد"
    >
        <div slot="header">
            <ui5-title level="H4">
                ویرایش تردد
            </ui5-title>
        </div>
        <div
            slot="header"
            class="fd-has-display-flex fd-margin-top-bottom--tiny"
            style="justify-content: end; width: 100%"
        >
            <ui5-button
                icon="decline"
                tooltip="بستن پنجره"
                design="Transparent"
                @click="closeDialogById('edit-record-dialog')"
            />
        </div>

        <div class="fd-margin-begin-end--md">
            <ui5-label
                id="edit-check-in-datetime-label"
                for="edit-check-in-datetime"
                show-colon=""
            >
                زمان تردد
            </ui5-label>
            <div>
                <ui5-datetime-picker
                    id="edit-check-in-datetime"
                    class="fd-margin-top-bottom--tiny"
                    format-pattern="yyyy-MM-dd HH:mm:ss"
                />
            </div>
        </div>
        <div
            slot="footer"
            class="fd-has-display-flex fd-has-align-items-center fd-margin-top-bottom--tiny"
            style="justify-content: end; width: 100%"
        >
            <ui5-button
                id="edit-record-button"
                design="Emphasized"
                icon="edit"
                @click="editRecordInDatabase"
            >
                ویرایش
            </ui5-button>
        </div>
    </ui5-dialog>


    <ui5-dialog
        id="error-state-dialog"
        header-text="خطا در ثبت تردد"
        state="Error"
    >
        <p>زمان خروج نباید کمتر از زمان ورود باشد!</p>
        <div
            slot="footer"
            class="fd-has-display-flex fd-has-align-items-center"
            style="justify-content: end; width: 100%"
        >
            <ui5-button
                id="error-close"
                @click="closeDialogById('error-state-dialog')"
            >
                بستن
            </ui5-button>
        </div>
    </ui5-dialog>

    <ui5-dialog
        id="ask-to-remove-record-dialog"
        header-text="حذف رکورد"
        state="Warning"
    >
        <p>
            آیا از حذف رکورد

            مطمئن هستید؟
        </p>
        <div
            slot="footer"
            class="fd-has-display-flex fd-has-align-items-center"
            style="justify-content: end; width: 100%"
        >
            <ui5-button
                class="fd-margin-end--tiny"
                icon="decline"
                @click="closeDialogById('ask-to-remove-record-dialog')"
            >
                بستن
            </ui5-button>
            <ui5-button
                id="remove-record-button"
                design="Negative"
                icon="delete"
                @click="destroyFromDatabase"
            >
                حذف
            </ui5-button>
        </div>
    </ui5-dialog>

    <ui5-dialog
        id="settings-dialog"
        icon="decline"
        header-text="تنظیمات"
    >
        <div slot="header">
            <ui5-title level="H4">
                تنظیمات
            </ui5-title>
        </div>
        <div
            slot="header"
            class="fd-has-display-flex fd-margin-top-bottom--tiny"
            style="justify-content: end; width: 100%"
        >
            <ui5-button
                icon="decline"
                tooltip="بستن پنجره"
                design="Transparent"
                @click="closeDialogById('settings-dialog')"
            />
        </div>

        <ui5-label
            id="themes-label"
            for="theme-options"
            show-colon=""
        >
            پوسته پنل
        </ui5-label>
        <div>
            <ui5-select
                id="theme-options"
                class="select"
                accessible-name-ref="themes-label"
                @change="handleThemeChange"
            >
                <ui5-option
                    v-for="theme of themes"
                    :key="theme.key"
                    :data-theme="theme.key"
                    :additional-text="theme.additional_text"
                >
                    {{ theme.label }}
                </ui5-option>
            </ui5-select>
        </div>

        <ui5-label
            id="densities-label"
            for="density-options"
            show-colon=""
        >
            اندازه پنل
        </ui5-label>
        <div>
            <ui5-select
                id="density-options"
                class="select"
                accessible-name-ref="densities-label"
                @change="handleContentDensitySwitchChange"
            >
                <ui5-option data-density="regular">
                    معمولی
                </ui5-option>
                <ui5-option data-density="compact">
                    کوچک
                </ui5-option>
            </ui5-select>
        </div>
    </ui5-dialog>
</template>

<script setup>
import '@ui5/webcomponents/dist/Select';
import '@ui5/webcomponents/dist/Table';
import '@ui5/webcomponents/dist/TableColumn';
import '@ui5/webcomponents/dist/TableRow';
import '@ui5/webcomponents/dist/TableCell';
import '@ui5/webcomponents/dist/DateTimePicker';
import '@ui5/webcomponents-fiori/dist/Page';
import '@ui5/webcomponents-localization/dist/features/calendar/Persian';
import {computed, onMounted, reactive, ref} from 'vue';
import {setTheme, getTheme} from '@ui5/webcomponents-base/dist/config/Theme';
import Pasoonate from 'pasoonate';
// eslint-disable-next-line import/no-extraneous-dependencies
import axios from 'axios';
import VSButton from '../components/SAP-UI5/VSButton.vue';
import VSLabel from '../components/SAP-UI5/VSLabel.vue';
import data from "bootstrap/js/src/dom/data";
import {useRouter} from "vue-router";

const selectedTheme = ref(getTheme());
const themes = [
    {
        key: 'sap_fiori_3',
        additional_text: 'روشن',
        label: 'Quartz Light',
    },
    {
        key: 'sap_fiori_3_dark',
        additional_text: 'تیره',
        label: 'Quartz Dark',
    },
    {
        key: 'sap_horizon',
        additional_text: 'روشن',
        label: 'Morning Horizon',
    },
    {
        key: 'sap_horizon_dark',
        additional_text: 'تیره',
        label: 'Evening Horizon',
    },
    {
        key: 'sap_horizon_hcb',
        additional_text: 'تیره',
        label: 'High Contrast Black',
    },
    {
        key: 'sap_horizon_hcw',
        additional_text: 'روشن',
        label: 'High Contrast White',
    },
    {
        key: 'sap_fiori_3_hcb',
        additional_text: 'تیره',
        label: 'Quartz High Contrast Black',
    },
    {
        key: 'sap_fiori_3_hcw',
        additional_text: 'روشن',
        label: 'Quartz High Contrast White',
    },
    {
        key: 'sap_belize',
        additional_text: 'روشن',
        label: 'Belize',
    },
    {
        key: 'sap_belize_hcb',
        additional_text: 'تیره',
        label: 'Belize High Contrast Black',
    },
    {
        key: 'sap_belize_hcw',
        additional_text: 'روشن',
        label: 'Belize High Contrast White',
    },
];

/**
 * @type []
 */
const localRecords = JSON.parse(localStorage.getItem('my_records'));

const records = ref(localRecords !== null ? localRecords : []);

let preventEnteringCheckOut;
const lastRecord = records.value[records.value.length - 1];

if (lastRecord !== undefined && lastRecord.checkOut === undefined) {
    preventEnteringCheckOut = ref(false);
} else {
    preventEnteringCheckOut = ref(true);
}

function showDialogById(dialogId, targetRef) {
    document.getElementById(dialogId).show(targetRef);
}

function closeDialogById(dialogId) {
    document.getElementById(dialogId).close();
}

function getDate(timestamp) {
    const date = new Date(timestamp * 1000);

    return date.toLocaleDateString('fa-IR');
}

function getTime(timestamp) {
    const date = new Date(timestamp * 1000);

    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    const seconds = date.getSeconds().toString().padStart(2, '0');

    return `${hours}:${minutes}:${seconds}`;
}

function calculateTimeDifference(checkInTimestamp, checkOutTimestamp) {
    const difference = checkOutTimestamp - checkInTimestamp;

    const hours = Math.floor(difference / 3600)
        .toString()
        .padStart(2, '0');
    const minutes = (Math.floor(difference / 60) % 60)
        .toString()
        .padStart(2, '0');
    const seconds = (difference % 60).toString().padStart(2, '0');

    return `${hours}:${minutes}:${seconds}`;
}

function enterNewCheckIn() {
    storeInDataBase();
}

function enterNewCheckOut() {
    storeInDataBase();
}

function getDayName(timestamp, locale) {
    return new Date(timestamp * 1000).toLocaleDateString(locale, {
        weekday: 'long',
    });
}

function sortRecords(unsortedRecords) {
    return unsortedRecords.sort(
        (firstRecord, secondRecord) => firstRecord.checkIn > secondRecord.checkIn,
    );
}

function saveRecord() {
    const checkInTimestamp = Pasoonate.make()
        .jalali(document.getElementById('check-in-datetime').value)
        .getTimestamp();
    const checkOutTimestamp = Pasoonate.make()
        .jalali(document.getElementById('check-out-datetime').value)
        .getTimestamp();

    if (checkOutTimestamp < checkInTimestamp) {
        showDialogById('error-state-dialog');

        return;
    }

    records.value.push({
        id: records.value.length + 1,
        checkIn: checkInTimestamp,
        checkOut: checkOutTimestamp,
    });

    records.value = sortRecords(records.value);

    localStorage.setItem('my_records', JSON.stringify(records.value));

    closeDialogById('add-new-record-dialog');
}

function findRecordById(recordId) {
    let result;

    records.value.forEach((record, index) => {
        if (record.id === recordId) {
            result = {
                record,
                index,
            };
        }
    });

    if (result === undefined) {
        return 'not found';
    }

    return result;
}

function handleEditRecord(id) {
    localStorage.setItem('record_id', id);
    showDialogById('edit-record-dialog');
}

function handleRemoveRecord(id) {

    localStorage.setItem('record_id', id);
    showDialogById('ask-to-remove-record-dialog');
}

function editRecord(event) {
    const editedCheckInTimestamp = Pasoonate.make()
        .jalali(document.getElementById('edit-check-in-datetime').value)
        .getTimestamp();
    const editedCheckOutTimestamp = Pasoonate.make()
        .jalali(document.getElementById('edit-check-out-datetime').value)
        .getTimestamp();

    if (editedCheckOutTimestamp < editedCheckInTimestamp) {
        showDialogById('error-state-dialog');

        return;
    }

    records.value[event.target.dataset.recordIndex].checkIn = editedCheckInTimestamp;
    records.value[event.target.dataset.recordIndex].checkOut = editedCheckOutTimestamp;

    records.value = sortRecords(records.value);

    localStorage.setItem('my_records', JSON.stringify(records.value));

    closeDialogById('edit-record-dialog');
}

const myTotal = computed(() => {
    const total = records.value.reduce((sumOfDifference, currentRecord) => {
        if (currentRecord.checkOut === undefined) {
            return sumOfDifference;
        }

        return (
            sumOfDifference + (currentRecord.checkOut - currentRecord.checkIn)
        );
    }, 0);

    const hours = Math.floor(total / 3600)
        .toString()
        .padStart(2, '0');
    const minutes = (Math.floor(total / 60) % 60).toString().padStart(2, '0');
    const seconds = (total % 60).toString().padStart(2, '0');

    return `${hours}:${minutes}:${seconds}`;
});

function handleThemeChange(event) {
    selectedTheme.value = event.detail.selectedOption.dataset.theme;
    setTheme(selectedTheme.value);
}

function handleContentDensitySwitchChange(event) {
    if (event.detail.selectedOption.dataset.density === 'compact') {
        document.body.setAttribute('data-ui5-compact-size', '');
    } else if (event.detail.selectedOption.dataset.density === 'regular') {
        document.body.removeAttribute('data-ui5-compact-size');
    }
}


onMounted(() => {
    document.querySelector(
        `[data-theme=${selectedTheme.value}]`,
    ).selected = true;
});

const user_name = ref();
user_name.value = localStorage.getItem('name');

const router = useRouter();

function logout_handler() {
    const formData = {
        token: localStorage.getItem('token'),
    };
    axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .post('/api/logout', formData)
            .then((response) => {
                console.log(response);
            })
            .catch((errors) => {
                console.log(errors);
            });
    });

    localStorage.setItem('token', null);
    localStorage.setItem('name', null);
    router.push({name: 'login'});
}

function storeInDataBase() {
    const formData = {
        token: localStorage.getItem('token'),
        shift_id: localStorage.getItem('shift_id'),
        department_id: localStorage.getItem('department_id'),
        date: Math.floor(Date.now() / 1000),
    };
    console.log(formData.date);
    axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .post('/api/timeSheets/create', formData)
            .then((response) => {
                console.log('register user success');
            })
            .catch((errors) => {
                console.log(errors);
            });
    });
    readFromDatabase();


}

const lists = ref([{}]);
let dates = reactive([]);
const result = ref([]);

async function readFromDatabase() {
    let formData = {
        token: localStorage.getItem('token'),
    };


    await axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .post('/api/timeSheets', formData)
            .then((response) => {

                lists.value = response.data;

                result.value = lists.value.reduce((acc, curr) => {
                    const dateString = new Date(curr.date).toISOString().substring(0, 10);
                    if (!acc[dateString]) {
                        acc[dateString] = [];
                    }
                    acc[dateString].push(curr);
                    return acc;
                }, {});


                lists.value.forEach(item => {
                    // let dateString = new Date(item.date).toISOString().substring(0, 10);
                    let dateString = Pasoonate.make(
                        Date.parse(item.date) / 1000
                    )
                        .jalali()
                        .format('yyyy-MM-dd ')
                    dates.push(dateString);
                })
                console.log(result.value)
            })
            .catch((error) => {
                console.log(error);
            });
    });

}

readFromDatabase()


async function editRecordInDatabase() {
    const editedCheckInTimestamp = Pasoonate.make()
        .jalali(document.getElementById('edit-check-in-datetime').value)
        .getTimestamp();
    console.log(editedCheckInTimestamp);
    let formData = {
        id: localStorage.getItem('record_id'),
        token: localStorage.getItem('token'),
        shift_id: localStorage.getItem('shift_id'),
        department_id: localStorage.getItem('department_id'),
        date: editedCheckInTimestamp,
    };
    console.log(formData.date)

    await axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .put(`/api/timeSheets/update/${formData.id}`, formData)
            .then((response) => {


                console.log("success");
            })
            .catch((error) => {
                console.log(error);
            });
    });
    closeDialogById('edit-record-dialog');
    readFromDatabase();
}

async function destroyFromDatabase() {
    let formData = {
        id: localStorage.getItem('record_id'),
        token: localStorage.getItem('token'),
    };
    await axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .delete(`/api/timeSheets/delete/${formData.id}`, formData)
            .then((response) => {


                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    closeDialogById('ask-to-remove-record-dialog');
    readFromDatabase();
}

function timeSet(timestamp) {
    return Pasoonate.make(
        Date.parse(timestamp) / 1000
    )
        .jalali()
        .format('HH:mm:ss')
    // .format('yyyy-MM-dd HH:mm:ss')
}

function dateSet(timestamp) {
    return Pasoonate.make(
        Date.parse(timestamp) / 1000
    )
        .jalali()
        .format('yyyy-MM-dd ')
}

// Menu
function menu_handler(event) {
    menuBasic.showAt(btnOpenBasic);
};

function create_shift_handler(event) {
    console.log("hrhe");
    // router.push({name:'createShift'});
}

</script>




