<template>
    <ui5-page id="dashboard-page" background-design="List" style="height: 100vh;">
        <div
            class="fd-margin-top-bottom--tiny fd-has-display-flex fd-has-align-items-center"
            style="justify-content: space-between"
        >
            <div class="fd-has-display-flex">
                <VSLabel
                    class="fd-margin-end--tiny"
                    show-colon=""
                >
                    جمع ساعت کاری
                </VSLabel>
                <VSLabel>{{ myTotal }}</VSLabel>
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

                <VSButton
                    class="fd-margin-end--tiny"
                    :disabled="preventEnteringCheckOut"
                    design="Negative"
                    icon="media-pause"
                    tooltip="ثبت خروج"
                    @click="enterNewCheckOut"
                >
                    ثبت خروج
                </VSButton>

                <VSButton
                    class="fd-margin-end--tiny"
                    icon="add-document"
                    tooltip="ثبت تردد"
                    @click="showDialogById('add-new-record-dialog')"
                >
                    ثبت تردد...
                </VSButton>

                <VSButton
                    class="fd-margin-end--tiny"
                    icon="settings"
                    tooltip="تنظیمات"
                    @click="showDialogById('settings-dialog')"
                >
                    تنظیمات...
                </VSButton>
            </div>
        </div>

        <ui5-table
            sticky-column-header
            no-data-text="داده‌ای موجود نیست!"
        >
            <ui5-table-column slot="columns">
                ردیف
            </ui5-table-column>
            <ui5-table-column
                slot="columns"
                demand-popin
                min-width="768"
                popin-text="ورود"
            >
                ورود
            </ui5-table-column>
            <ui5-table-column
                slot="columns"
                demand-popin
                min-width="768"
                popin-text="خروج"
            >
                خروج
            </ui5-table-column>
            <ui5-table-column slot="columns">
                نتیجه
            </ui5-table-column>
            <ui5-table-column
                slot="columns"
                demand-popin
                min-width="768"
                popin-text="عملیات"
                style="text-align: center"
            >
                عملیات
            </ui5-table-column>

            <ui5-table-row
                v-for="record of records"
                :key="record.id"
            >
                <ui5-table-cell>
                    1
                </ui5-table-cell>
                <ui5-table-cell>
                    {{ getDayName(record.checkIn, 'fa-IR') }}
                    -
                    {{ getDate(record.checkIn) }}
                    -
                    {{ getTime(record.checkIn) }}
                </ui5-table-cell>
                <ui5-table-cell>
                    <template v-if="record.checkOut !== undefined">
                        {{ getDayName(record.checkOut, 'fa-IR')}}
                        -
                        {{ getDate(record.checkOut) }}
                        -
                        {{ getTime(record.checkOut) }}
                    </template>
                    <template v-else>
                        ---
                    </template>
                </ui5-table-cell>
                <ui5-table-cell>{{ record.checkOut !== undefined ? calculateTimeDifference(record.checkIn, record.checkOut) : '---' }}</ui5-table-cell>
                <ui5-table-cell class="fd-has-display-flex">
                    <VSButton
                        class="fd-margin-end--tiny"
                        :data-record-id="record.id"
                        icon="request"
                        @click="handleEditRecord"
                    >
                        ویرایش...
                    </VSButton>
                    <VSButton
                        :data-record-id="record.id"
                        design="Negative"
                        icon="delete"
                        @click="handleRemoveRecord"
                    >
                        حذف...
                    </VSButton>
                </ui5-table-cell>
            </ui5-table-row>
        </ui5-table>
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
            style="justify-content: end; width: 100%;"
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
                زمان ورود
            </ui5-label>
            <div>
                <ui5-datetime-picker
                    id="edit-check-in-datetime"
                    class="fd-margin-top-bottom--tiny"
                    format-pattern="yyyy-MM-dd HH:mm:ss"
                />
            </div>
        </div>

        <div class="fd-margin-begin-end--md">
            <ui5-label
                id="edit-check-out-datetime-label"
                for="edit-check-out-datetime"
                show-colon=""
            >
                زمان خروج
            </ui5-label>
            <div>
                <ui5-datetime-picker
                    id="edit-check-out-datetime"
                    class="fd-margin-top-bottom--tiny"
                    format-pattern="yyyy-MM-dd HH:mm:ss"
                />
            </div>
        </div>

        <div
            slot="footer"
            class="fd-has-display-flex fd-has-align-items-center fd-margin-top-bottom--tiny"
            style="justify-content: end; width: 100%;"
        >
            <ui5-button
                id="edit-record-button"
                design="Emphasized"
                icon="edit"
                @click="editRecord"
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
            style="justify-content: end; width: 100%;"
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
            آیا از حذف رکورد روز
            <span
                id="to-be-deleted-record"
                class="fd-margin-begin-end--tiny"
            />
            مطمئن هستید؟
        </p>
        <div
            slot="footer"
            class="fd-has-display-flex fd-has-align-items-center"
            style="justify-content: end; width: 100%;"
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
                @click="removeRecord"
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
import { computed, onMounted, ref } from 'vue';
import { setTheme, getTheme } from '@ui5/webcomponents-base/dist/config/Theme';
import Pasoonate from 'pasoonate';
import VSButton from '../components/SAP-UI5/VSButton.vue';
import VSLabel from '../components/SAP-UI5/VSLabel.vue';

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

    const hours = Math.floor(difference / 3600).toString().padStart(2, '0');
    const minutes = (Math.floor(difference / 60) % 60).toString().padStart(2, '0');
    const seconds = (difference % 60).toString().padStart(2, '0');

    return `${hours}:${minutes}:${seconds}`;
}

function enterNewCheckIn() {
    preventEnteringCheckOut.value = false;

    records.value.push({
        id: records.value.length + 1,
        checkIn: Math.floor(Date.now() / 1000),
    });

    localStorage.setItem('my_records', JSON.stringify(records.value));
}

function enterNewCheckOut() {
    preventEnteringCheckOut.value = true;

    records.value[records.value.length - 1].checkOut = Math.floor(Date.now() / 1000);

    localStorage.setItem('my_records', JSON.stringify(records.value));
}

function getDayName(timestamp, locale) {
    return (new Date(timestamp * 1000)).toLocaleDateString(locale, { weekday: 'long' });
}

function sortRecords(unsortedRecords) {
    return unsortedRecords.sort((firstRecord, secondRecord) => firstRecord.checkIn > secondRecord.checkIn);
}

function saveRecord() {
    const checkInTimestamp = Pasoonate.make().jalali(document.getElementById('check-in-datetime').value).getTimestamp();
    const checkOutTimestamp = Pasoonate.make().jalali(document.getElementById('check-out-datetime').value).getTimestamp();

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

function handleEditRecord(event) {
    const foundRecord = findRecordById(+event.target.dataset.recordId);

    document.getElementById('edit-check-in-datetime').value = Pasoonate.make(foundRecord.record.checkIn).jalali().format('yyyy-MM-dd HH:mm:ss');
    document.getElementById('edit-check-out-datetime').value = Pasoonate.make(foundRecord.record.checkOut).jalali().format('yyyy-MM-dd HH:mm:ss');
    document.getElementById('edit-record-button').dataset.recordIndex = foundRecord.index;

    showDialogById('edit-record-dialog');
}

function handleRemoveRecord(event) {
    const foundRecord = findRecordById(+event.target.dataset.recordId);

    document.getElementById('to-be-deleted-record').textContent = Pasoonate.make(foundRecord.record.checkIn).jalali().format('yyyy-MM-dd HH:mm:ss');

    document.getElementById('remove-record-button').dataset.recordIndex = foundRecord.index;

    showDialogById('ask-to-remove-record-dialog');
}

function removeRecord(event) {
    records.value.slice(+event.target.dataset.recordIndex, 1);

    localStorage.setItem('my_records', JSON.stringify(records.value));
}

function editRecord(event) {
    const editedCheckInTimestamp = Pasoonate.make().jalali(document.getElementById('edit-check-in-datetime').value).getTimestamp();
    const editedCheckOutTimestamp = Pasoonate.make().jalali(document.getElementById('edit-check-out-datetime').value).getTimestamp();

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

const myTotal = computed(function () {
    let total = records.value.reduce((sumOfDifference, currentRecord) => {
        if (currentRecord.checkOut === undefined) {
            return sumOfDifference;
        }

        return sumOfDifference + (currentRecord.checkOut - currentRecord.checkIn);
    }, 0);

    const hours = Math.floor(total / 3600).toString().padStart(2, '0');
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

onMounted(function () {
    document.querySelector("[data-theme=" + selectedTheme.value + "]").selected = true;
})

</script>
